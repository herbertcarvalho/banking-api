<?php

namespace App\Http\Controllers;

#Requests
use App\Http\Requests\transferAmountRequest;
use App\Http\Requests\historicotransferenciaRequest;

#Models
use App\Models\transferencias;
use App\Models\contas_abertas;
use App\Models\info_usuario;

#Import
use Illuminate\Support\Facades\Response;

class transferenciasController extends Controller
{

    public function index()
    {
        return transferencias::with(['doador', 'receptor'] )->get();
    }

    public function historicotransferencia(historicotransferenciaRequest $request){

        $request =$request->validated();
        $conta = $request['conta'];
        $infoConta = transferencias::with(['doador', 'receptor'])
            ->whereRaw("transferencias.conta_doadora = $conta OR transferencias.conta_doadora = $conta")
            ->get();

        if($infoConta->isEmpty()){
            return Response::json([
                'message' => 'esta combinacao de conta e agencia nao existe'
            ],404);
        }

        return $infoConta;
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
                'message' => 'o novo saldo do doador é menor que 0 impossibilitando a transferencia'
            ],404);
        }

        contas_abertas::with([])
            ->where(['contas_abertas.conta' => $input['conta_doador']])
            ->update(['saldo_atual' => $novoSaldoDoador]);

        contas_abertas::with([])
            ->where(['contas_abertas.conta' => $input['conta_receptor']])
            ->update(['saldo_atual' => $novoSaldoReceptor]);

        $contaDoadorInfoUsu = info_usuario::with([])
            ->where(['info_usuarios.id' => $id_doador[0]['id_info_usuario']])
            ->get();

        $contaReceptoraInfoUsu = info_usuario::with([])
            ->where(['info_usuarios.id' => $id_receptor[0]['id_info_usuario']])
            ->get();

        $transferencias = transferencias::create([
            'doador_id' => $contaDoadorInfoUsu[0]['id_users'],
            'receptor_id'=> $contaReceptoraInfoUsu[0]['id_users'],
            'conta_doadora'=> $input['conta_doador'],
            'conta_receptora' => $input['conta_receptor'],
            'quantia_transferida' => $input['valor'],
            'data_transferencia' => date('Y-m-d')
        ]);

            return Response::json([
                'saldo_doador' => $novoSaldoDoador,
                'saldo_receptor' => $novoSaldoReceptor,
                'transferencia' => $transferencias,
            ],200);

        }else{

            if($id_doador->isEmpty()){
                return Response::json([
                    'message' => 'a conta doadora nao esta cadastrada no banco'
                ],404);
            }else if($id_receptor->isEmpty()){
                return Response::json([
                    'message' => 'a conta receptora nao esta cadastrada no banco'
                ],404);
            }
        }
    }
}
