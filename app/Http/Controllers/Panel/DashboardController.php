<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // TODO : send some data to view
        return view('panel.pages.dashboard');
    }
}