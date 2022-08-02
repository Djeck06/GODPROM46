<?php

namespace App\Http\Livewire\Admin\Commands;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use App\Models\OrderAppointment;
use Livewire\Component;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Services\ProcessTrait;


class Assignmodal extends Component
{
   
        use WithSorting, WithPerPagePagination, WithCachedRows  , ProcessTrait;
    
    
        public $showAssignModal = false;
        public OrderAppointment $appointment;
        public $transporter = [] ;
       


        public $filters = [
            'search' => '',
        ];
    
        protected $listeners = [
            'assignto'
        ];
        protected $queryString = ['sorts'];
    
        public function rules()
        {
            $rules = OrderAppointment::assigntotransporterRules();
            return $rules ;
        }
    
        public function mount()
        {
            $this->perPage = 5;
            $this->editing = $this->makeBlankOrderAppointment(); 
            $this->editing->transport = [] ;
        }
    
    
    
        public function makeBlankOrderAppointment()
        {
            return OrderAppointment::make();
        }
    
    
        public function assignto(OrderAppointment $appointment)
        {
            $this->useCachedRows();
            $this->transporter = [] ;
            $this->editing->transport = [] ;
            if ($this->editing->isNot($appointment)) $this->editing = $appointment;
            $this->showAssignModal = true;
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
            $this->__assigntransporter__($this->editing , $this->transporter) ;
            //$this->emit('nameToParent',$this->editing);

            
            $this->showAssignModal = false;
    
        }
    
        public function render()
        {
          
            return view('livewire.admin.appointments.assigntotransportermodal', [
                'transporters' => $this->rows,
            ]);
         
        }
    }
    