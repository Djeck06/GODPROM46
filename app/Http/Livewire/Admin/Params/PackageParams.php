<?php

namespace App\Http\Livewire\Admin\Params;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Package;
use Livewire\Component;

class PackageParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;
    public $showEditModal = false;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Package $package;

    public function rules()
    {
        return [
            'editing.package_type_id' => 'required|exists:package_types,id',
            'editing.pickup_delivery_country_id' => 'required|exists:countries,id',
            'editing.delivery_delivery_country_id' => 'required|exists:countries,id',
            'editing.price' => 'required|numeric',
            'editing.is_active' => 'boolean',
            'editing.notes' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPackage();
    }

    public function makeBlankPackage()
    {
        return Package::make(['is_active' => false]);
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCountry();

        $this->showEditModal = true;
    }

    public function edit(Package $package)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($package)) $this->editing = $package;

        $this->showEditModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Package::query()
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
        return view('livewire.admin.params.packages', [
            'packages' => $this->rows,
        ]);
    }
}
