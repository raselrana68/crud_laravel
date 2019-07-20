<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    function userRegister(Request $request){
        // User::create([
        //     'username' => 'Namen',
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'birthdate'=> $request['birthdate'],
        //     'city'=> $request['city'],
        //     'country'=>$request['country'],
        // ]);

        $request->validate([
            'username'=> 'required',
            'email'=>'required|email',
            'password'=> 'required',
            'birthdate'=> 'required|date',
            'city'=> 'required',
            'country'=> 'required',
            'agree'=> 'required',
        ]);

        User::insert([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'birthdate'=>$request->birthdate,
            'city'=>$request->city,
            'country'=>$request->country,
        ]);
        return back()->with( 'success' , 'Successfully registered');    
    }
}
