<?php

namespace App\Models;

#Import
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class transferencias extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'conta_doadora',
        'conta_receptora',
        'doador_id',
        'receptor_id',
        'quantia_transferida',
        'data_transferencia'
    ];

    #dar uma olhada nos belongs
    public function doador(){
        return $this->belongsTo('App\Models\User');
    }

    public function receptor(){
        return $this->belongsTo('App\Models\User');
    }
}
