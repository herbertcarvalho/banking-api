<?php

namespace App\Models;

#Import
use Illuminate\Database\Eloquent\Model;

class contas_abertas extends Model
{
    protected $fillable = [
        'id_info_usuario',
        'conta',
        'agencia',
        'saldo_atual'
    ];

    public function info_usu(){
        $request = $this->belongsTo('App\Models\info_usuario','id_info_usuario');
        return $request;
    }
}
