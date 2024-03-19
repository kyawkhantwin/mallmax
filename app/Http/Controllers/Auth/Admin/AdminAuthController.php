<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    //
    public function adminShowLogin()
    {
//       redirect if the user is try to access
        if (Auth::guard('web')->check()){
            return  redirect()->back()->with('You are not admin');
        }
        return view('auth.adminAuth.admin_login');
    }

    public function adminPostLogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        $cre = [
            'email' => $email,
            'password' => $password
        ];
        if (!Auth::guard('admin')->attempt($cre)){
        //        Redirect if not admin
            return redirect()->back()->with('error','Admin account does\'nt registered yet. Register to login');
        }
        return redirect('/admin/dashboard')->with('success','Welcome to admin account '. Auth::guard('admin')->user()->name);
    }

    public function adminShowRegister()
    {
    //  redirect if the user is try to access
        if (Auth::guard('web')->check()){
            return  redirect()->back()->with('You are not admin');
        }
        return view('auth.adminAuth.admin_register');
    }

    public function adminPostRegister(Request $request)
    {
        $validate = $request ->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'name' => 'required|max:20',
            'password' => 'required|min:8',
            'phone' => 'required',
            'address' => 'required|string',
        ]);

        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();

        $image->move(public_path("/admin/" . $image_name));

        $email = $request->email;
        $name = $request->name;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->address;


        Admin::create([
            'image' => $image_name,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            "address" => $address,
            "phone" => $phone,
            'slug' => Str::slug($name),
            'email_verified_at' => now()
        ]);

        return redirect('/admin/login')->with('success','Admin Account Registered');
    }

    public function adminLogOut(Request $request)
    {
        if(!Auth::guard('admin')->check()){
            return redirect('/admin/login')->with('error','Admin Account Log in first');
        }
        Auth::guard('admin')->logout();

        return redirect('/admin/login')->with('success','LogOut');
    }
}
