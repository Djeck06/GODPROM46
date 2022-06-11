<?php

namespace App\Http\Livewire\Client\Account;

use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    use WithSorting, WithPerPagePagination, WithCachedRows;

    public $filters = [
        'search' => '',
        'status' => '',
        'price' => ''
    ];

    // protected $queryString = ['sorts'];

    public function getRowsQueryProperty()
    {
        $query = auth()->user()->client->orders()
            ->latest()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('reference', 'like', '%' . $search . '%'));

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
        return view('livewire.client.account.orders', [
            'orders' => $this->rows,
        ]);
    }
}
