<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard method
    public function index()
    {
        return view('dashboard');
    }
    // End Method
}
