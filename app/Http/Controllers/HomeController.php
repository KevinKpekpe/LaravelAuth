<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showAdminHome()
    {
        return view('home.admin');
    }

    public function showClientHome()
    {
        return view('home.client');
    }
}
