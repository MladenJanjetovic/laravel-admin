<?php

namespace SystemInc\LaravelAdmin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use View;

class AjaxController extends Controller
{
    public function __construct()
    {
        // head meta defaults
        View::share('head', [
            'title'       => 'SystemInc Admin Panel',
            'description' => '',
            'keywords'    => '',
        ]);
    }
}