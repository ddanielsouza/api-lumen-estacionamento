<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    use \App\Helpers\ISOSerialization;

    protected $table = "estacionamentos";
    
    protected $fillable = [
        'id',
        'name',
    ];
}
