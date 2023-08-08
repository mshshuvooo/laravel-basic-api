<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        if( Auth::attempt(['email' => $email, 'password' => $password]) ){
            return Auth::user();
        }else{
            return response()->json(["error" => "Wrong eamil or password"], 404);
        }
    }
}
