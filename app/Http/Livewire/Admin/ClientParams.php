<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Client;
use Livewire\Component;

class ClientParams extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;
    public $showEditModal = false;

    public $filters = [
        'search' => '',
    ];

    protected $queryString = ['sorts'];

    public Client $client;

    public function rules()
    {
        return [
            'editing.first_name' => 'required',
            'editing.last_name' => 'required',
            'editing.phone' => 'required',
            // 'editing.description' => 'nullable',
            'editing.status' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankPackage();
    }

    public function makeBlankPackage()
    {
        return Client::make();
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankPackage();

        $this->showEditModal = true;
    }

    public function edit(Client $client)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($client)) $this->editing = $client;

        $this->showEditModal = true;
    }

    public function getRowsQueryProperty()
    {
        $query = Client::query() ;
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
        $this->editing->status =  ($this->editing->status == true)? 1 : 0 ; 
  
        $this->editing->save();

        $this->showEditModal = false;
    }

    public function render()
    {
      
        return view('livewire.admin.clients', [
            'clients' => $this->rows,
        ]);
    }
}
