<?php

namespace App\Http\Livewire\Client\Order;

use Livewire\Component;

class OrderForm extends Component
{
    public $items = [];

    public function addItem()
    {
        array_push($this->items, $this->makeBlankItem());
    }

    public function removeItem($i)
    {
        unset($this->items[$i]);
    }

    public function makeBlankItem()
    {
        return [
            'type' => 'standard',
            'name' => 'est',
            'quantity' => 1,
            'has_insurance' => null,
            'weight' => null,
            'length' => null,
            'width' => null,
            'height' => null,
            'upload' => null
        ];
    }


    public function render()
    {
        return view('livewire.client.order.order-form');
    }
}
