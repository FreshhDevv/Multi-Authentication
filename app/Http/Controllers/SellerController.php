<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function Index() {
        return view('seller.seller_login');
    } //end method

    public function SellerDashboard() {
        return view('seller.index');
    } //end method

    public function SellerLogin(Request $request) {
        //dd($request->all());
        $check = $request->all();
        if(Auth::guard('seller')->attempt([
            'email' => $check['email'],
            'password' => $check['password']
        ])) {
            return redirect()->route('seller.dashboard')->with('error', 'Seller Login Successful');
        } else {
            return back()->with('error', 'Invalid Credentials');
        }
    } //end method
}
