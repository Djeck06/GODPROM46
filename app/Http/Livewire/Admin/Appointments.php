<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use App\Models\OrderAppointment;
use Livewire\Component;
use App\Services\ProcessTrait;
use DB ;



class Appointments extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows , ProcessTrait;

   
    public $showDetailModal  = false;
    public $showAssignModal = false;
    public OrderAppointment $appointment;
    public $selectappointment ;
    public Transporter $transporter;
    public $etat;
    public $secondtitle ;

    public $filters = [
        'search' => '',
    ];

    protected $listeners = [
        'nameToParent'
     ];


    protected $queryString = ['sorts'];
    
    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *
     * @param String    $closure
     * @param OrderAppointment   $appointment
     *
     * @return  void
     */
    public function next( String $closure , OrderAppointment $appointment)
    {
       
        $this->currentmethodname = $closure ;
        $method= static::$methods[$closure] ;
        $this->$method($appointment); 
    }

    public function nameToParent(OrderAppointment $appointment)
    {
        if ($this->editing->isNot($appointment))  $this->editing = $appointment;
    }

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
        
        $this->editing = $this->makeBlankOrderAppointment();
        $this->selectappointment = $this->makeBlankOrderAppointment();
    }

    public function makeBlankCarrier()
    {
        return Transporter::make();
    }

    public function makeBlankOrderAppointment()
    {
        return OrderAppointment::make();
    }



    public function show(OrderAppointment $appointment)
    {
        $this->useCachedRows();
        $this->selectappointment = $appointment;

        $this->items = [$this->makeBlankItem()];
        unset($this->items[0]);
        $this->items = array_values($this->items) ;
        $this->selectappointment->items->map(
            function ($item, $key) {
                $this->addItem(['type' => $item->package_id,
                'quantity' => $item->quantity,
                'has_insurance' => $item->has_insurance]) ;
            }
        );
        $this->showDetailModal = true;
    }

   

    public function tiket(OrderAppointment $appointment)
    {
        $this->useCachedRows();
        $this->emit('tiket', $appointment);
    }



    public function getRowsQueryProperty()
    {
        $table =$this->editing->getTable() ;
        
        $query = OrderAppointment::query()->select($table.'.*','status.created_at'); 
        
        if(!is_null($this->etat)){ 
            $etat = $this->etat ;
            $query = $query->join('status', $table.'.id', '=', 'status.source_id')->orderBy('status.created_at', 'desc')
            ->where('source', $table)
            ->where('status.label', $etat )
            ->whereIn('status.id', function ($query) use ($table) {
                $query->selectRaw('MAX(status.id) as last_status_id')
                    ->from('status')
                    ->where('source', $table)
                    ->groupBy('status.source_id');
            });
        }else{ 
            $query = $query->join('status', $table.'.id', '=', 'status.source_id')->orderBy('status.created_at', 'desc')
            ->where('source', $table)
            ->whereIn('status.id', function ($query) use ($table) {
                $query->selectRaw('MAX(status.id) as last_status_id')
                    ->from('status')
                    ->where('source', $table)
                    ->groupBy('status.source_id');
            }) ;

        }

        


        $query = $query->when($this->filters['search'], fn ($query, $search) => $query->where('reference', 'like', '%' . $search . '%'));

        // foreach($query->with('status')->get() as $item){
        //     dump($item->toArray() , $item->lasttstatus->toArray()) ;
        // }
        // dd('t') ;
        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }


    public function render()
    {
        //dd($this->rows) ;
        return view('livewire.admin.appointments', [
            'datas' => $this->rows,
        ]);
    }
}
