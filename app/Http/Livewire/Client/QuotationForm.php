<?php

namespace App\Http\Livewire\Client;

use App\Events\Quotation\QuotationWasCreated;
use App\Models\Item;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class QuotationForm extends Component
{
    use WithFileUploads;

    public $head_office_pickup;
    public $pickup_country;
    public $pickup_city;
    public $pickup_address;

    public $delivery_country;
    public $delivery_city;
    public $delivery_address;
    public $delivery_phone;

    public $notes;

    public Quotation $quotation;

    public $items = [];

    protected $rules = [
        'items.0.type' => 'required|in:standard,medium,other',
        'items.0.name' => 'required',
        'items.0.quantity' => 'required|numeric',
        'items.0.has_insurance' => 'nullable',
        'items.0.weight' => 'required_if:items.0.type,other',
        'items.0.length' => 'required_if:items.0.type,other',
        'items.0.width' => 'required_if:items.0.type,other',
        'items.0.height' => 'required_if:items.0.type,other',
        'items.0.upload' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

        'items.*.type' => 'required|in:standard,medium,other',
        'items.*.name' => 'required',
        'items.*.quantity' => 'required|numeric',
        'items.*.has_insurance' => 'nullable',
        'items.*.weight' => 'nullable',
        'items.*.length' => 'required_if:items.*.type,other',
        'items.*.width' => 'required_if:items.*.type,other',
        'items.*.height' => 'required_if:items.*.type,other',
        'items.*.upload' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',


        'quotation.pickup_at_office' => 'nullable',
        'quotation.pickup_country' => 'required_unless:head_office_pickup,false',
        'quotation.pickup_city' => 'required_unless:head_office_pickup,false',
        'quotation.pickup_address' => 'required_unless:head_office_pickup,false',

        'quotation.delivery_country' => 'required',
        'quotation.delivery_city' => 'required',
        'quotation.delivery_address' => 'required',
        'quotation.delivery_phone' => 'required',

        'quotation.notes' => 'nullable',
        'quotation.status' => 'sometimes'
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
        // return Item::make([
        //     'type' => 'standard',
        //     'name' => 'est',
        //     'quantity' => 1
        // ]);
        return [
            'type' => 'standard',
            'name' => 'est',
            'quantity' => 1,
            'has_insurance' => null,
            'weight' => null,
            'length' => null,
            'width' => null,
            'height' => null,
            'upload' => null
        ];
    }

    public function makeBlankQuotation()
    {
        return Quotation::make([
            'status' => 'pending',
        ]);
    }
    public function mount()
    {
        $this->items = [$this->makeBlankItem()];
        $this->quotation = $this->makeBlankQuotation();
    }

    public function save()
    {
        $this->validate();

        $client = auth()->user()->client;
        $quotation = $client->quotations()->save($this->quotation);

        foreach ($this->items as $item) {
            $quotation->items()->save($item);
        }

        $quotation->items()->saveMany($this->items);

        
        // dd($quotation);
        // DB::transaction(function () {

            
        // });

        // $this->emitSelf('notify-saved');
        // $this->notify("Quotation was created successfully");

        // event(new QuotationWasCreated());
    }

    public function render()
    {
        return view('livewire.client.quotation-form');
    }
}
