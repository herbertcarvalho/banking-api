<?php

namespace App\Http\Controllers;

#Request
use App\Http\Requests\RegisterUserRequest;

#Models
use App\Models\User;


class userController extends Controller
{

    public function getallusers(){
        return User::with([])->get();
    }

    public function register(RegisterUserRequest $request)
    {
        $input = $request->validated();

        $input['password'] = bcrypt($input['password']);
        User::create($input);
        return response()->json([
            'message' => 'Registro concluido com sucesso'
        ],200);
    }
}
