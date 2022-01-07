<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function Index() {
        return view('admin.admin_login');
    }

    public function Dashboard() {
        return view('admin.index');
    }

    public function Login(Request $request) {
        //dd($request->all());
        $check = $request->all();
        if(Auth::guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin Login Successful');
        } else {
            return back()->with('error', 'Invalid Credentials');
        }
    }
}
