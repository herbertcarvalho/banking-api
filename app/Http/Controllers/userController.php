<?php

namespace App\Http\Controllers;

#Request
use App\Http\Requests\RegisterUserRequest;

#Models
use App\Models\User;

#imports
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{

    public function getallusers(){
        $request = User::with([])->get();
        if($request ->isEmpty()){
            return Response::json([
                'message' => 'nao possui nenhum cadastro de usuario'
            ],404);
        }else{
            return Response::json([
                'message' => 'requisicao concluida com sucesso',
                'Usuarios' => $request
            ],200);
        }
    }

    public function register(RegisterUserRequest $request)
    {

        $input = $request->validated();

        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return response()->json([
            'message' => 'Registro concluido com sucesso'
        ],200);
    }
}
