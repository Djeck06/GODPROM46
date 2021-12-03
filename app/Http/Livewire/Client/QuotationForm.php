<?php

namespace App\Http\Livewire\Client;

use Livewire\Component;

class QuotationForm extends Component
{
    public $items = [];
    public $i = 1;

    public function addItem($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->items, $i);
    }

    public function removeItem($i)
    {
        unset($this->items[$i]);
    }

    public function render()
    {
        return view('livewire.client.quotation-form');
    }
}
