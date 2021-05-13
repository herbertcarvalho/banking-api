<?php

namespace App\Models;

#Import
use Illuminate\Database\Eloquent\Model;

class transferencias extends Model
{
    protected $fillable = [
        'doador_id',
        'receptor_id',
        'quantia_transferida',
        'data_transferencia'
    ];

    public function doador(){
        return $this->belongsTo('App\Models\User');
    }

    public function receptor(){
        return $this->belongsTo('App\Models\User');
    }
}
