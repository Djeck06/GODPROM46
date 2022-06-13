<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Package;
use Livewire\Component;

class BoxeParams extends Component
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
            'editing.name' => 'required',
            'editing.description' => 'nullable',
            'editing.image' => 'nullable',
            'editing.is_active' => 'boolean',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPackage();
    }

    public function makeBlankPackage()
    {
        return Package::make(['is_active' => true]);
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPackage();

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
      
        return view('livewire.admin.boxes', [
            'packages' => $this->rows,
        ]);
    }
}
