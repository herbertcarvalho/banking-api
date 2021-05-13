<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contas_abertas extends Model
{
    protected $fillable = [
        'conta',
        'agencia',
        'saldo'
    ];

    public function contas(){
        return $this->belongsTo('App\Models\info_usuario');
    }

}
