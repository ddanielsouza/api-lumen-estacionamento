<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracaoEstacionamento extends Model
{
    use \App\Helpers\ISOSerialization;

    protected $table = "configuracoesEstacionamentos";
    
    protected $fillable = [
        'id',
        'valorHora',
        'estacionamento_id',
    ];

    public function scopePermissaoEstacionamento($q){
        return $q->where('estacionamento_id', \Auth::user()->estacionamento_id);
    }
}
