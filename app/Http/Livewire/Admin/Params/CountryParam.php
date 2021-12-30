<?php

namespace App\Http\Livewire\Admin\Params;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Country;
use Livewire\Component;

class CountryParam extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;

    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showImportModal = false;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Country $country;

    public function rules()
    {
        return [
            'editing.name' => 'required|unique:countries,name,' . $this->editing->id,
            'editing.code' => 'required|min:2|max:2|unique:countries,code,' . $this->editing->id,
            'editing.is_pickup_country' => 'boolean',
            'editing.is_delivery_country' => 'boolean',
        ];
    }


    public function mount()
    {
        $this->editing = $this->makeBlankCountry();
    }

    public function makeBlankCountry()
    {
        return Country::make(['is_pickup_country' => false, 'is_delivery_country' => false]);
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCountry();

        $this->showEditModal = true;
    }

    public function edit(Country $country)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($country)) $this->editing = $country;

        $this->showEditModal = true;
    }

    public function showImportModal()
    {
        $this->showImportModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Country::query()
            ->orderBy('name', 'asc')
            ->when($this->filters['search'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'));

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
        return view('livewire.admin.params.countries', [
            'countries' => $this->rows,
        ]);
    }
}
