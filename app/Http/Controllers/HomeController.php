<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SalonController;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home');
    }
}
