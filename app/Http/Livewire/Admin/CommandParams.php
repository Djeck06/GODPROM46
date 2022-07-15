<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use App\Models\Order;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\ProcessTrait;



class CommandParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows , ProcessTrait;
    public $showEditModal = false;
    public $showDetailModal  = false;
    public $showAssignModal = false;
    public $sendToPackagingModal = false;
    public $selectedsdata = [];
    public Order $order;
    public $selectorder ;
    public $selectAll = false ;
    public Transporter $transporter;
    public $etat;
    public $secondtitle ;

    public $filters = [
        'search' => '',
    ];


    protected $queryString = ['sorts'];


    public function rules()
    {
        return [
           
            
            'editing.client_id' => 'required',
            'editing.pickup_country' => 'required',
            'editing.pickup_city'=> 'required',
            'editing.pickup_address'=> 'required',

            'editing.delivery_country'=> 'required',
            'editing.delivery_city'=> 'required',
            'editing.delivery_address'=> 'required',
            'editing.delivery_phone'=> 'required',

            'editing.notes'=> 'nullable',
            'editing.status'=> 'nullable', //pending | paying | paid | processing | completed | cancelled | refunded | closed | failed | expired |

              
            'items.0.type' => 'required|numeric',
            // 'items.0.name' => 'required',
            'items.0.quantity' => 'required|numeric',
            'items.0.has_insurance' => 'nullable',
    
            'items.*.type' => 'required|numeric',
            // 'items.*.name' => 'required',
            'items.*.quantity' => 'required|numeric',
            'items.*.has_insurance' => 'nullable',
        ];
    }

    public function mount()
    {
        
        $this->editing = $this->makeBlankOrder();
        $this->selectorder = new Order();
        $this->items = [$this->makeBlankItem()];
        $this->resultmessages = Null;

    }

    public function makeBlankCarrier()
    {
        return Transporter::make();
    }

    public function makeBlankOrder()
    {
        return Order::make();
    }

    public function create()
    {
        $this->useCachedRows();
        $this->items = [$this->makeBlankItem()];
        if ($this->editing->getKey()) $this->editing = $this->makeBlankOrder();

        $this->showEditModal = true;
    }

    public function edit(Order $order)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($order)) $this->editing = $order;

        $this->items = [$this->makeBlankItem()];
        unset($this->items[0]);
        $this->items = array_values($this->items) ;
        $this->editing->items->map(
            function ($item, $key) {
                $this->addItem(['type' => $item->package_id,
                'quantity' => $item->quantity,
                'has_insurance' => $item->has_insurance]) ;
            }
        )->toArray() ;
        
        $this->showEditModal = true;
    }


    public function show(Order $order)
    {
        $this->useCachedRows();
        $this->selectorder = $order;

        $this->items = [$this->makeBlankItem()];
        unset($this->items[0]);
        $this->items = array_values($this->items) ;
        $this->selectorder->items->map(
            function ($item, $key) {
                $this->addItem(['type' => $item->package_id,
                'quantity' => $item->quantity,
                'has_insurance' => $item->has_insurance]) ;
            }
        );
        $this->showDetailModal = true;
    }

   

    public function assign(Order $order)
    {
        $this->useCachedRows();
        $this->emit('assign', $order);
    }

    public function tiket(Order $order)
    {
        $this->useCachedRows();
        $this->emit('tiket', $order);
    }


    
    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        13/07/2022 23:15
     * @since      13/07/2022 23:15
     *
     * @param String    $closure
     * @param Order   $order
     *
     * @return  void
     */
    public function next( String $closure , Order $order)
    {
        
        $this->sendToPackagingModal = true;

        $this->useCachedRows();
        if ($this->editing->isNot($order)) $this->editing = $order;
        $this->editing->delivery_phone = Null ;
        $this->currentmethodname = $closure ;
        $method= static::$methods[$closure] ;
        
        if($this->$method($order)) $this->resultmessages ='success'; 

    }


    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        13/07/2022 23:15
     * @since      13/07/2022 23:15
     *  mass assign to packaging
     * @param Order   $order
     *
     * @return  void
     */
    public function sendToPackaging( Order $order)
    {
       
        $successdata = [] ;
        foreach($this->selectedsdata as $order_id){
            $get  = Order::find($order_id) ;
            if($get->packagings->count() == 0){
                $get->packagings()->create([]) ;
                $successdata[] = $get->id ;
            }
        }
        $this->resultmessages ='success at'. implode( "," , $successdata ) ;
        $this->selectedsdata = [] ;
        $this->sendToPackagingModal = true;

    }

    public function getRowsQueryProperty()
    {
        $query = Order::query() ;
       
        if(!is_null($this->etat)){ 
            $etat = $this->etat ;
            $query = $query->whereHas('lastStatus', function ($q) use($etat) {
                $q->where('label', $etat);
            }) ;

            //dd( $query->toSql()) ;
            // dd( $query->with('lastStatus')->get()) ;
        }else{ 
            $query = $query->whereHas('status', function ($q){
                $q->where('label', 'paid')->orWhere('label', 'readytopickup');
            });
        }
        $query = $query->when($this->filters['search'], fn ($query, $search) => $query->where('reference', 'like', '%' . $search . '%'));


        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function addItem(Array $item = [])
    {
        if(empty($item )){
            array_push($this->items, $this->makeBlankItem());
            
        }else{
            array_push($this->items, $item);

        }
    }

    public function removeItem($i)
    {
        unset($this->items[$i]);
    }

    public function makeBlankItem()
    {
        return [
            'type' => 1,
            // 'name' => '',
            'quantity' => 1,
            'has_insurance' => null,
        ];
    }

    public function getPickupCountriesProperty()
    {
        return \App\Models\Country::where('is_pickup_country', true)->has('pickup_country_prices')->get();
    }

    public function getDeliveryCountriesProperty()
    {
        return \App\Models\Country::where('is_delivery_country', true)->has('delivery_country_prices')->get();
    }

    public function getPackagesProperty()
    {
        return \App\Models\Package::where('is_active', true)->get();
    }

    public function save()
    {
        $this->validate();
        $orderitems = [];
        
        foreach ($this->items as $item) {
            $price = \App\Models\Price::where('package_id', $item['type'])->where('pickup_country_id', $this->editing->pickup_country)->where('delivery_country_id', $this->editing->delivery_country)->first();
            $insurance =  0;
           
            $orderitems[] = [
                'package_id' => $item['type'],
                'price' => $price->price,
                'insurance_price' => $insurance,
                'quantity' => $item['quantity'],
                'subtotal' => $price->price * $item['quantity'],
                'total' => $price->price * $item['quantity'] + $insurance,
            ];
        }
     
        $client = auth()->user()->client;

        $this->editing->status= 'paid' ;
        $this->editing->price =  array_sum(array_column($orderitems, 'subtotal')); ;
        $this->editing->insurance = array_sum(array_column($orderitems, 'insurance_price'));
        $this->editing->total = array_sum(array_column($orderitems, 'total'));
       
        $this->editing->save();
       

        $syncData = array();
        foreach($orderitems as $item){
            $syncData[$item['package_id']] =['quantity' => $item['quantity'],
                                             'price' => $item['price']];
        }

        $this->editing->packages()->sync($syncData);
       
        

        if (!file_exists(public_path('orders/qrcode'))) {
            mkdir(public_path('orders/qrcode'), 0777, true);
        }

        try {
            QrCode::size('200')->generate($this->editing->reference, public_path('orders/qrcode/' . $this->editing->reference . '.svg'));
        } catch (\Error $e) {
            //throw $th;
            dd($e->getMessage());
        }
 
         //Dispatch OrderWasCreated event
        $this->showEditModal = false;
    }

    public function render()
    {
        //dd($this->rows) ;
        return view('livewire.admin.orders', [
            'commands' => $this->rows,
        ]);
    }
}
