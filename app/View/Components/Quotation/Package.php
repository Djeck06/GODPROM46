<?php

namespace App\View\Components\Quotation;

use Illuminate\View\Component;

class Package extends Component
{
    public $item;
    public $key;

    public function __construct($item, $key = null)
    {
        $this->key = $key;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.quotation.package');
    }
}
