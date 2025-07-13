<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainSalaryEmployee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = MainSalaryEmployee::get();
        return view('dashboard.index', compact('data'));
    }
}