<?php

namespace App\View\Components\Quotation;

use Illuminate\View\Component;

class Package extends Component
{
    public $key;
    public $errors;

    public function __construct($key, $errors = [])
    {
        $this->key = $key;
        $this->errors = $errors;
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
