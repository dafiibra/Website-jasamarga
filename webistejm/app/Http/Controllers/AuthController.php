<?php

namespace App\Http\Controllers;

use App\Models\inspektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    function loginPost(Request $request){
        $request->validate([
            "username"=> "required",
            "password"=> "required",
        ]);
        $credentials = $request->only('username', 'password');
        if(Auth::guard('inspektor')->attempt($credentials)){
            session(['user' => Auth::guard('inspektor')->user()]);
            return redirect()->intended(route(name:"dashboard"));
        }
        return redirect(route(name:"login"))->with("error","Login Failed");

    }
    
    function register()
    {
        return view('auth/register');
    }

    function registerPost(Request $request){
        $request->validate([
            "username"=> "required",
            "fullname"=> "required",
            "division"=> "required",
            "email"=> "required",
            "password"=> "required",
        ]);

        $user = new inspektor();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->division = $request->division;
        $user->status = "requested";
        $user->accepted_by = "NULL";
        $user->rejected_by = "NULL";
        $user->deleted_by = "NULL";
        
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect(route(name:"login"))
            ->with("success","user created successfully");
        }
        return redirect(route(name:"register"))
        ->with("error","Failed to create an account");

    }
    
    public function logout()
    {
        Auth::guard('inspektor')->logout();
        session()->flush();
        return redirect()->route('login');
    }
   
}
