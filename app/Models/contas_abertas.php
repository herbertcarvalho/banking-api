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

}
