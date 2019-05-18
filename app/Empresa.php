<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
         'dni',
         'domicilio',
         'cuit',
         'celular',
         'telefono',
         'email',
         'observaciones' 
     ];

    public function cliente() {
    	return $this->hasMany('Camino\Cliente');
    }

  

}
