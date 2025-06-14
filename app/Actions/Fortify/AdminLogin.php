<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\AdminRequest;
use Illuminate\Http\Request;

class AdminLogin
{
    public function store(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if (
            $admin &&
            Hash::check($request->password, $admin->password)
        ) {
            return $admin;
        }
    }
}
