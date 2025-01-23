<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class AdministratorDashboard extends Controller
{
    public function index()
    {
        return view('administrator.dashboard.list');
    }
}
