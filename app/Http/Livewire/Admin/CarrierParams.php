<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transporter;
use Livewire\Component;

class CarrierParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;
    public $showEditModal = false;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Transporter $transporter;

    public function rules()
    {
        return [
            'editing.firstname' => 'required',
            'editing.lastname' => 'required',
            'editing.phone' => 'required',
            'editing.description' => 'nullable',
            'editing.tva_number' => 'nullable',
            'editing.siren_number' => 'nullable',
            'editing.siret_number' => 'nullable',
            'editing.naf_code' => 'nullable',
            'editing.registration_number' => 'nullable'
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPackage();
    }

    public function makeBlankPackage()
    {
        return Transporter::make();
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPackage();

        $this->showEditModal = true;
    }

    public function edit(Transporter $transporter)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($transporter)) $this->editing = $transporter;

        $this->showEditModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Transporter::query() ;
            // ->when($this->filters['search'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'));

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
        // dd($this->editing);

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function render()
    {
      
        return view('livewire.admin.carriers', [
            'transporters' => $this->rows,
        ]);
    }
}
