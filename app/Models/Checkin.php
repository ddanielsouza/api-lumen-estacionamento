<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use \App\Helpers\ISOSerialization;

    protected $table = "checkins";
    
    protected $fillable = [
        'id',
        'placa',
        'user_id',
        'dataCheckout',
        'valor',
    ];

    public $casts = [
        'dataCheckout' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function scopePermissaoEstacionamento($query){
        return $query->whereHas('user', function ($q){
            return $q->where('estacionamento_id', \Auth::user()->estacionamento_id);
        });
    }

}
