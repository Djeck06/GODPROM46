<?php

namespace App\Http\Livewire\Admin\Commands;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use App\Models\Order;
use Livewire\Component;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Services\ProcessTrait;



class Sendtopackagingmodal extends Component
{
    
    use WithSorting, WithPerPagePagination, WithCachedRows  , ProcessTrait;


    public $showToPackagingModal = false;
    public Order $order;
    public $filters = [
        'search' => '',
    ];

    protected $listeners = [
        'toPackaging'
    ];
    protected $queryString = ['sorts'];

    public function rules()
    {
        $rules = Order::sendtopackagingRules();
        return $rules ;
    }

    public function mount()
    {
        $this->perPage = 5;
        $this->editing = $this->makeBlankOrder();
        
    }



    public function makeBlankOrder()
    {
        return Order::make();
    }


    public function toPackaging(Order $order)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($order)) $this->editing = $order;
        $this->showToPackagingModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Transporter::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('firstname', 'like', '%' . $search . '%')->orWhere('lastname', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%'));
        //dd($query->with('medias')->get()) ;
        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }


   

    
    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        13/07/2022 23:15
     * @since      13/07/2022 23:15
     *
     * @return  void
     */
    public function save()
    {
        $this->__sendtopackagings__($this->editing) ;
        $this->emit('nameToParent',$this->editing);
        $this->showToPackagingModal = false;

    }

    public function render()
    {
      
        return view('livewire.admin.commands.toPackagingmodal', [
            'transporters' => $this->rows,
        ]);
        // return view('livewire.admin.commands.ToPackagingmodal', [
        //     'commands' => $this->rows,
        // ]);
    }
}
