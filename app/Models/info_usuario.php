<?php

namespace App\Models;

#Import
use Illuminate\Database\Eloquent\Model;

class info_usuario extends Model
{
    protected $fillable = [
        'id_users',
        'nome',
        'data_nascimento',
    ];
}
