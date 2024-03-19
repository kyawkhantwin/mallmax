<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
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
        if (!Auth::attempt($cre)){
            return redirect()->back()->with('error','Account does\'nt have. Register to login');
        }
        return redirect('/')->with('success','Welcome ' . Auth::user()->name);
    }

    public function logout()
    {
        if (!Auth::check()){
            return redirect('/user/login')->with('error','You haven\'t login yet');
        }
         Auth::logout();
         return redirect('/user/login')->with('error','You have been logout');
    }

    public function showRegister()
    {
        return view('auth.register');
    }
    public function postRegister(Request $request)
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

        $image->move(public_path('/user/' . $image_name));

        $email = $request->email;
        $name = $request->name;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->address;


        User::create([
           'image' => $image_name,
           'name' => $name,
           'email' => $email,
           'password' => Hash::make($password),
            "address" => $address,
            "phone" => $phone,
            'slug' => Str::slug($name),
            'email_verified_at' => now()
        ]);

        return redirect('/user/login')->with('success','Account Registered');

    }


}
