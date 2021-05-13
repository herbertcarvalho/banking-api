<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
