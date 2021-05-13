<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
