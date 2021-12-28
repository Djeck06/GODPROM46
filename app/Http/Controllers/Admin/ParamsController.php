<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParamsController extends Controller
{
    public function countries()
    {
        return view('admin.params.countries', [
            'title' => __('Gestions des pays'),
        ]);
    }

    public function packages()
    {
        return view('admin.params.packages', [
            'title' => __('Gestions des types de colis'),
        ]);
    }

    public function prices()
    {
        return view('admin.params.prices', [
            'title' => __('Gestions des prix'),
        ]);
    }
}
