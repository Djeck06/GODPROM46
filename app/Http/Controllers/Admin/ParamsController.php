<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParamsController extends Controller
{
    public function countries()
    {
        return view('admin.params.country', [
            'title' => __('Gestions des pays'),
        ]);
    }
}
