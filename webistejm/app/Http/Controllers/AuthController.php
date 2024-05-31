<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    function loginPost(Request $request){
        $request->validate([
            "fullname"=> "required",
            "password"=> "required",
        ]);
      
    }

    function register()
    {
        return view('auth/register');
    }

    function registerPost(Request $request){
        $request->validate([
            "fullname"=> "required",
            "email"=> "required",
            "password"=> "required",
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect(route(name:"login"))
            ->with("success","user created successfully");
        }
        return redirect(route(name:"register"))
        ->with("error","Failed to create an account");

    }
    
   
}
