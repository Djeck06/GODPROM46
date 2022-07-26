<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use App\Models\Deposit;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\ProcessTrait;
use DB ;



class Deposits extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows , ProcessTrait;
    public $showEditModal = false;
    public $showDetailModal  = false;
    public $showAssignModal = false;
    public $sendToDepositModal = false;
    public $selectedsdata = [];
    public Deposit $deposit;
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
        
        $this->editing = $this->makeBlankDeposit();
        $this->selectDeposit = new Deposit();
        $this->resultmessages = Null;

    }

    public function makeBlankCarrier()
    {
        return Transporter::make();
    }

    public function makeBlankDeposit()
    {
        return Deposit::make();
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
    // public function next( String $closure , Order $order)
    // {
        
    //     $this->sendToDepositModal = true;

    //     $this->useCachedRows();
    //     if ($this->editing->isNot($order)) $this->editing = $order;
    //     $this->editing->delivery_phone = Null ;
    //     $this->currentmethodname = $closure ;
    //     $method= static::$methods[$closure] ;
        
    //     if($this->$method($order)) $this->resultmessages ='success'; 

    // }

    public function getRowsQueryProperty()
    {
        $query = Deposit::query()->select('deposits.*') ;
        
        if(!is_null($this->etat)){ 
            $etat = $this->etat ;
            $query = $query->join('status', 'deposits.id', '=', 'status.source_id')
            ->where('source', 'deposits')
            ->where('status.label', $etat )
            ->whereIn('status.created_at', function ($query) {
                $query->selectRaw('MAX(status.created_at) as last_post_created_at')
                    ->from('status')
                    //->join('status', 'Deposits.id', '=', 'status.source_id')
                    ->where('source', 'deposits')
                    ->orderBy('status.id', 'desc')
                    ->groupBy('status.source_id');
            })->orderBy('status.id', 'desc');
        }else{ 
            $query = $query->join('status', 'deposits.id', '=', 'status.source_id')->where('source','deposits')->orderBy('status.created_at','desc') ;

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


    public function save()
    {
        $this->validate();
       
        $this->editing->save();
       
        $this->showEditModal = false;
    }

    public function render()
    {
        //dd($this->rows) ;
        return view('livewire.admin.deposits', [
            'deposits' => $this->rows,
        ]);
    }
}
