<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomDashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.user'); // Tampilkan view untuk dashboard kustom
    }
}
