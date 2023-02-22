<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('pages.dashboard');
        }
    }

    public function maintenance()
    {
        return view('pages.maintenance');
    }

    public function error()
    {
        return view('pages.404');
    }
}
