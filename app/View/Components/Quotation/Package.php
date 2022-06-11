<?php

namespace App\View\Components\Quotation;

use Illuminate\View\Component;

class Package extends Component
{
    public $key;
    public $packages;

    public function __construct($key, $packages)
    {
        $this->key = $key;
        $this->packages = $packages;
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
