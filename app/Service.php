<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'vehiculo_id',
        'fecha',
        'titulo',
        'detalle',
        'importe',
        'vigencia',
    ];

    public function vehiculo() {
        return $this->belongsTo('Camino\Vehiculo');
    }
}
