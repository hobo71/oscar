<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'domicilio',
        'domicilio_temporal',
        'celular',
        'telefono',
        'email',
        'vip',
        'observaciones',
        
    ];

    public function alquileres() {
        return $this->hasMany('Camino\Alquiler');
    }

    public function empresa() {
    	return $this->belongsTo('Camino\Empresa');
    }

}
