<?php

namespace App\Http\Livewire\Admin\Commands;


use App\Models\Packaging;
use Livewire\Component;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Services\ProcessTrait;



class Deliverymodal extends Component
{
    
    use  WithCachedRows  , ProcessTrait;


    public $showdeliveryModal = false;
    public Packaging $packaging;
    public $filters = [
        'search' => '',
    ];

    protected $listeners = [
        'transmitpackaging'
    ];
   
    public function rules()
    {
        $rules = Packaging::transmitpackagingRules();
        return $rules ;
    }

    public function mount()
    {
        $this->perPage = 5;
        $this->editing = $this->makeBlankPackaging();
        
    }


    public function makeBlankPackaging()
    {
        return Packaging::make();
    }


    public function transmitpackaging(Packaging $packaging)
    {
       
        $this->useCachedRows();
        if ($this->editing->isNot($packaging)) $this->editing = $packaging;
        $this->currentmethodname = 'transmitpackaging' ;
        $this->showdeliveryModal = true;
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
        $this->__transmitpackaging__($this->editing) ;
        $this->emit('nameToParent',$this->editing);
        $this->showdeliveryModal = false;

    }

    public function render()
    {
        
        return view('livewire.admin.packagings.deliverymodal');
    }
}
