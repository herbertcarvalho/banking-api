<?php

namespace App\Http\Controllers;

use App\Http\Requests\bodyLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function logar(bodyLoginRequest $request){
        $token = Str::random(60);

        $User = User::with([])
            ->where(['email' =>$request['email']])
            ->get('password');

        if (Hash::check($request['password'] , $User->first()->password)) {
            User::with([])
            ->where(['email' => $request['email']])
            ->update(['remember_token' => $token]);
        }

        return response()->json([
            'Bearrer' => $token
        ],200);
    }
}
