<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\AdminRequest;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.index', compact('admins'));
    }
}