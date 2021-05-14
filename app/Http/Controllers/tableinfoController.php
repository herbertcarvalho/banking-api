<?php

namespace App\Http\Controllers;

#Requests
use App\Http\Requests\infoUserRequest;

#Models
use App\Models\info_usuario;
use App\Models\User;

#Imports
use Illuminate\Support\Facades\Response;

class tableinfoController extends Controller
{
    public function registrarUsuarioTableInfo(infoUserRequest $request){

        $request = $request->validated();

        $userRequest = User::with([])
                        ->where(['users.email'=> $request['email']])
                        ->get();

        $infoUserRequest = info_usuario::with([])
            ->where(['info_usuarios.id_users' => $userRequest[0]['id']])
            ->get();

        if(!($infoUserRequest->isEmpty())){
            return Response::json([
                'message' => 'o cliente ja possui cadastro na tabela info_usuarios'
            ],404);
        }

        info_usuario::create([
            'id_users' => $userRequest[0]['id'],
            'nome' => $request['name'],
            'data_nascimento' => $request['data_nascimento']
        ]);

        return Response::json([
            'message' => 'o cliente foi cadastrado com sucesso'
        ],200);
    }
}
