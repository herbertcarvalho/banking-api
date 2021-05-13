<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferencias;
use App\Models\contas_abertas;
use App\Models\User;
use App\Http\Requests\transferAmountRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;

use function PHPUnit\Framework\isEmpty;

class transferenciasController extends Controller
{
    public function index()
    {
        return transferencias::with(['doador', 'receptor'] )->get();
    }

    public function fazertransferencia(transferAmountRequest $request)
    {

        $input = $request->validated();

        $id_doador = contas_abertas::with([])
            ->where(['contas_abertas.conta' =>$input['conta_doador']])
            ->get();

        $id_receptor = contas_abertas::with([])
            ->where(['contas_abertas.conta' => $input['conta_receptor']])
            ->get();

        if(!($id_doador->isEmpty() || $id_receptor->isEmpty())){

            $novoSaldoDoador = $id_doador[0]['saldo_atual'] - $input['valor'];
            $novoSaldoReceptor = $id_receptor[0]['saldo_atual'] + $input['valor'];

            if($novoSaldoDoador<0){
                return Response::json([
                    'status_code' => 400,
                    'message' => 'o novo saldo do doador é menor que 0 impossibilitando a transferencia'
                ]);
            }

            contas_abertas::with([])
            ->where(['contas_abertas.conta' => $input['conta_doador']])
            ->update(['saldo_atual' => $novoSaldoDoador]);

            contas_abertas::with([])
            ->where(['contas_abertas.conta' => $input['conta_receptor']])
            ->update(['saldo_atual' => $novoSaldoReceptor]);

            $transferencias = transferencias::create([
                'doador_id' => $id_doador[0]['id'],
                'receptor_id'=> $id_receptor[0]['id'],
                'quantia_transferida' => $input['valor'],
                'data_transferencia' => date('Y-m-d')
            ]);

            return Response::json([
                'status_code' => 200,
                'saldo_doador' => $novoSaldoDoador,
                'saldo_receptor' => $novoSaldoReceptor,
                'transferencia' => $transferencias,
            ]);
        }else{
            if($id_doador->isEmpty()){
                return Response::json([
                'status_code' => 400,
                'message' => 'a conta doadora nao esta cadastrada no banco'
                ]);
            }else if($id_receptor->isEmpty()){
                return Response::json([
                    'status_code' => 400,
                    'message' => 'a conta receptora nao esta cadastrada no banco'
                ]);
            }
        }
    }
}
