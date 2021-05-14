<?php

namespace App\Http\Controllers;

#Requests
use App\Http\Requests\allContasRequest;
use App\Http\Requests\contaagenciaRequest;
use App\Http\Requests\getInfoAccountRequest;

#Models
use App\Models\info_usuario;
use App\Models\User;
use App\Models\contas_abertas;


#Imports
use Illuminate\Support\Facades\Response;

class contaagenciaController extends Controller
{

    public static function generateConta(){
        return random_int(1,999999);
    }

    public static function generateAgencia(){
        return random_int(1,9999);
    }

    public function getinfoaccount(getInfoAccountRequest $request){

        $request =$request->validated();
        $infoConta = contas_abertas::with([])
            ->where(['contas_abertas.conta' => $request['conta']])
            ->where(['contas_abertas.agencia' => $request['agencia']])
            ->get();

        if($infoConta->isEmpty()){
            return Response::json([
                'status_code' => 400,
                'message' => 'esta combinacao de conta e agencia nao existe'
            ]);
        }

        return Response::json([
            'status_code' => 200,
            'message' => $infoConta
        ]);;
    }

    public function getAllContasEmail(allContasRequest $request){

        $json_error_status_code = 400;

        $request = $request->validated();
        $idTableUsers= User::with([])
            ->where(['users.email' => $request['email']])
            ->get();

        if($idTableUsers->isEmpty()){
            return Response::json([
                'status_code' => $json_error_status_code,
                'message' => 'o email na solicitacao nao possui cadastro no banco'
            ]);
        }

        $idTableInfoUser = info_usuario::with([])
            ->where(['info_usuarios.id_users' => $idTableUsers[0]['id']])
            ->get();

        if($idTableInfoUser->isEmpty()){
            return Response::json([
                'status_code' => $json_error_status_code,
                'message' => 'é necessario cadastrar o cliente no tabela info_usuarios'
            ]);
        }

        $contasUsuario = contas_abertas::with([])
            ->where(['contas_abertas.id_info_usuario' => $idTableInfoUser[0]['id']])
            ->get();

        return $contasUsuario;
    }

    public function registrarConta(contaagenciaRequest $request){

        $json_error_status_code = 400;

        $request = $request->Validated();

        $idTableUsers = User::with([])
            ->where(['users.email' => $request['email']])
            ->get();

        if($idTableUsers->isEmpty()){
            return Response::json([
                'status_code' => $json_error_status_code,
                'message' => 'o email na solicitacao nao possui cadastro no banco'
            ]);
        }
        $idTableInfoUser = info_usuario::with([])
            ->where(['info_usuarios.id_users' => $idTableUsers[0]['id']])
            ->get();

        if($idTableInfoUser->isEmpty()){
            return Response::json([
                'status_code' => $json_error_status_code,
                'message' => 'é necessario cadastrar o cliente no tabela info_usuarios'
            ]);
        }

        $contaGerada=123456;
        $agenciaGerada=123456;

        while(!(contas_abertas::with([])->where(['contas_abertas.conta' => $contaGerada])->get())->isEmpty()
                && !(contas_abertas::with([])->where(['contas_abertas.agencia' => $contaGerada])->get()) ->isEmpty()){
                    $contaGerada=contaagenciaController::generateConta();
                    $agenciaGerada =contaagenciaController::generateAgencia();
                }


        contas_abertas::create([
            'id_info_usuario' => $idTableInfoUser[0]['id'],
            'conta' => $contaGerada,
            'agencia' => $agenciaGerada,
            'saldo_atual' => $request['saldo_desejado']
        ]);

        return Response::json([
                'status_code' => 200,
                'message' => 'Conta e agencia gerada com sucesso',
                'conta' => $contaGerada,
                'agencia' => $agenciaGerada
            ]);
    }
}
