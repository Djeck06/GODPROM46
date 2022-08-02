<?php

namespace App\Http\Livewire\Admin\Commands;


use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\Order;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Tiketmodal extends Component
{
    use  WithCachedRows;

    public $showTiketModal = false;

    public Order $order;
    public $filters = [
        'search' => '',
    ];

    protected $listeners = [
        'tiket'
    ];



    public function mount()
    {
        $this->editing = $this->makeBlankOrder();
    }



    public function makeBlankOrder()
    {
        return Order::make();
    }


    public function tiket(Order $order)
    {
        $this->useCachedRows();
        if ($this->editing->isNot($order)) $this->editing = $order;
        $this->showTiketModal = true;
    }

    public function render()
    { 
        return view('livewire.admin.commands.tiketmodal');
    }
}
