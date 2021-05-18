<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getinfoaccount(getInfoAccountRequest $request){

        $request =$request->validated();

        $infoConta = contas_abertas::with([])
            ->where(['contas_abertas.conta' => $request['conta']])
            ->where(['contas_abertas.agencia' => $request['agencia']])
            ->get();

        if($infoConta->isEmpty()){
            return Response::json([
                'message' => 'esta combinacao de conta e agencia nao existe'
            ],404);
        }

        return Response::json([
            'message' => $infoConta
        ],200);
    }
}
