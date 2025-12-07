<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        return view('backend.pages.dashboard');
    }
}
