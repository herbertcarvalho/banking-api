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

        $json_error_status_code = 400;

        $request = $request->validated();

        $userRequest = User::with([])
                        ->where(['users.email'=> $request['email']])
                        ->get();

        $infoUserRequest = info_usuario::with([])
            ->where(['info_usuarios.id_users' => $userRequest[0]['id']])
            ->get();

        if(!($infoUserRequest->isEmpty())){
            return Response::json([
                'status_code' => $json_error_status_code,
                'message' => 'o cliente ja possui cadastro na tabela info_usuarios'
            ]);
        }

        info_usuario::create([
            'id_users' => $userRequest[0]['id'],
            'nome' => $request['name'],
            'data_nascimento' => $request['data_nascimento']
        ]);

        return Response::json([
            'status_code' => 200,
            'message' => 'o cliente foi cadastrado com sucesso'
        ]);
    }
}
