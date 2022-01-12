<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class SellerController extends Controller
{
    public function SellerIndex() {
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

    public function SellerLogout() {
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_form')->with('error', 'Seller Logout Successfully');
    } //end method

    public function SellerRegister() {
        return view('seller.seller_register');
    } //end method

    public function SellerRegisterCreate(Request $request) {
        // dd($request->all());

        Seller::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('seller_login_form')->with('error', 'Seller Created Successfully');
    }

}
