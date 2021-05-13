<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class info_usuario extends Model
{
    protected $fillable = [
        'nome',
        'data_nascimento',
    ];

    public function id_users(){
        return $this->belongsTo('App\Models\User');
    }
}
