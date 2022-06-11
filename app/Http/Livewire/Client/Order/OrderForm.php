<?php

namespace App\Http\Livewire\Client\Order;

use App\Events\Order\OrderWasCreated;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Package;
use App\Models\Price;
use Livewire\Component;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderForm extends Component
{
    public Order $order;
    public $items = [];
    public $prices = [];
    public $summary = [];
    public $showSummary = false;
    public $loading = false;

    private $insurance_price = 5;

    protected $rules = [
        'order.pickup_country' => 'required',
        'order.pickup_city' => 'required',
        'order.pickup_address' => 'required',

        'order.delivery_country' => 'required',
        'order.delivery_city' => 'required',
        'order.delivery_address' => 'required',
        'order.delivery_phone' => 'required',

        'items.0.type' => 'required|numeric',
        'items.0.name' => 'required',
        'items.0.quantity' => 'required|numeric',
        'items.0.has_insurance' => 'nullable',

        'items.*.type' => 'required|numeric',
        'items.*.name' => 'required',
        'items.*.quantity' => 'required|numeric',
        'items.*.has_insurance' => 'nullable',

        'order.notes' => 'nullable',
        'order.status' => 'sometimes'
    ];

    public function addItem()
    {
        array_push($this->items, $this->makeBlankItem());
    }

    public function removeItem($i)
    {
        unset($this->items[$i]);
    }

    public function makeBlankItem()
    {
        return [
            'type' => 1,
            'name' => '',
            'quantity' => 1,
            'has_insurance' => null,
        ];
    }

    public function getPickupCountriesProperty()
    {
        return Country::where('is_pickup_country', true)->get();
    }

    public function getDeliveryCountriesProperty()
    {
        return Country::where('is_delivery_country', true)->get();
    }

    public function getPackagesProperty()
    {
        return Package::where('is_active', true)->get();
    }

    public function makeblankOrder()
    {
        return Order::make(['status' => 'pending']);
    }

    public function mount()
    {
        $this->items = [$this->makeBlankItem()];
        $this->order = $this->makeblankOrder();
    }

    public function doSummary()
    {
        $this->validate();
        $this->prices = [];
        
        foreach ($this->items as $item) {
            $price = Price::where('package_id', $item['type'])->where('pickup_country_id', $this->order->pickup_country)->where('delivery_country_id', $this->order->delivery_country)->first();
            $insurance = $item['has_insurance'] ? $this->insurance_price : 0;
            $package = Package::find($item['type']);

            $this->prices[] = [
                'package_id' => $item['type'],
                'pickup_country_id' => $this->order->pickup_country,
                'delivery_country_id' => $this->order->delivery_country,
                'package_name' => $package->name,
                'pickup_country_name' => Country::find($this->order->pickup_country)->name,
                'delivery_country_name' => Country::find($this->order->delivery_country)->name,
                'label' => $item['name'],
                'image' => $package->image ? asset($package->image) : asset('images/package/default.jpeg'),
                'price' => $price->price,
                'insurance_price' => $insurance,
                'quantity' => $item['quantity'],
                'subtotal' => $price->price * $item['quantity'],
                'total' => $price->price * $item['quantity'] + $insurance,
            ];
        }
        // dd($this->prices);
        $this->summary['subtotal'] = array_sum(array_column($this->prices, 'subtotal'));
        $this->summary['insurance'] = array_sum(array_column($this->prices, 'insurance_price'));
        $this->summary['total'] = array_sum(array_column($this->prices, 'total'));

        $this->order->price = $this->summary['subtotal'];
        $this->order->insurance = $this->summary['insurance'];
        $this->order->total = $this->summary['total'];

        $this->showSummary = true;
    }

    public function save()
    {
        // dd($this->order);
        $client = auth()->user()->client;

        $order = $client->orders()->create([
            'pickup_country' => $this->order->pickup_country,
            'pickup_city' => $this->order->pickup_city,
            'pickup_address' => $this->order->pickup_address,
            'delivery_country' => $this->order->delivery_country,
            'delivery_city' => $this->order->delivery_city,
            'delivery_address' => $this->order->delivery_address,
            'delivery_phone' => $this->order->delivery_phone,
            'notes' => $this->order->notes,
            'status' => 'pending',
            'price' => $this->summary['subtotal'],
            'insurance' => $this->summary['insurance'],
            'total' => $this->summary['total'],
        ]);

        foreach ($this->prices as $item) {
            $order->items()->save(new OrderItem([
                'package_id' => $item['package_id'],
                'name' => $item['label'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'has_insurance' => $item['insurance_price'] > 0
            ]));
        }

        if (!file_exists(public_path('orders/qrcode'))) {
            mkdir(public_path('orders/qrcode'), 0777, true);
        }

        try {
            QrCode::size('200')->generate($order->reference, public_path('orders/qrcode/' . $order->reference . '.svg'));
        } catch (\Error $e) {
            //throw $th;
            dd($e->getMessage());
        }

        //Dispatch OrderWasCreated event
        OrderWasCreated::dispatch($order);

        return redirect()->route('orders.show', $order->reference)->with('success', 'Commande créé avec succès');
    }


    public function render()
    {
        return view('livewire.client.order.order-form');
    }
}
