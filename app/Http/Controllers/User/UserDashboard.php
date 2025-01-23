<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserDashboard extends Controller
{
    public function index()
    {
        return view('user.dashboard.list');
    }
}
