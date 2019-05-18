<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
		'valor_auto_chico',
		'valor_auto_grande',
		'valor_camioneta',
		'descuento',
		'descuento_vip'
    ];
}
