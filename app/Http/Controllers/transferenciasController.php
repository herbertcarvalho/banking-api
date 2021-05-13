<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferencias;
use App\Models\contas_abertas;
use App\Models\User;
use App\Http\Requests\transferAmountRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;

class transferenciasController extends Controller
{
    public function index()
    {
        return transferencias::with(['doador', 'receptor'] )->get();
    }

    public function getbyuser()
    {
        $user = auth()->user();
        $transferencias = transferencias::with([])
            ->whereRaw("transferencias.doador_id = $user->id OR transferencias.receptor_id = $user->id")
            ->orderBy('created_at')
            ->get();
        return response()->json($transferencias);
    }

    public function fazertransferencia(transferAmountRequest $request)
    {
        $input = $request->validated();
        $id_doador = contas_abertas::with(['contas'])
            ->where(['contas_abertas.conta' =>$input['conta_doador']])
            ->get();

        $id_receptor = contas_abertas::with(['contas'])
            ->where(['contas_abertas.conta' => $input['conta_receptor']])
            ->get();

        if(($id_doador==null || $id_receptor==null)){

            $novoSaldoDoador = $id_doador[0]['saldo_atual'] - $input['valor'];
            $novoSaldoReceptor = $id_receptor[0]['saldo_atual'] + $input['valor'];

            if($novoSaldoDoador<0){
                return Response::json([
                    'fodase o padrao' => 66666,
                ]);
            }

            contas_abertas::with(['contas'])
            ->where(['contas_abertas.conta' => $input['conta_doador']])
            ->update(['saldo_atual' => $novoSaldoDoador]);

            contas_abertas::with(['contas'])
            ->where(['contas_abertas.conta' => $input['conta_receptor']])
            ->update(['saldo_atual' => $novoSaldoReceptor]);

            $transferencias = transferencias::create([
                'doador_id' => $id_doador[0]['id'],
                'receptor_id'=> $id_receptor[0]['id'],
                'quantia_transferida' => $input['valor'],
                'data_transferencia' => date('Y-m-d')
            ]);

            return Response::json([
                'saldo_doador' => $novoSaldoDoador,
                'saldo_receptor' => $novoSaldoReceptor,
                'transferencia' => $transferencias
            ]);
        }else{
            return Response::json([
                'fodase o padrao' => 66666,
            ]);
        }
    }
}
