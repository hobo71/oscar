<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vehiculo extends Model
{
    
    protected $dates = ['vto_rto', 'vto_seguro', 'vto_habilitacion'];
    protected $clases = ['auto chico','auto mediano','auto grande','camioneta'];
    protected $fillable = ['marca_id', 'modelo', 'patente', 'anio', 'clase', 'ciudad', 'puertas', 'cubiertas', 'vto_seguro', 'vto_rto', 'vto_habilitacion', 'color', 'kilometros','observaciones'];
    protected $ciudades = ['Río Grande','Ushuaia','Tolhuin','Otra'];

    public function alquileres() {
        return $this->hasMany('Camino\Alquiler');
    }
    
    public function services() {
        return $this->hasMany['Camino\Service'];
    }

    public function marca() {
        return $this->belongsTo('Camino\Marca');
    }
    
    public function clase(){
        return $this->clases[$this->clase];
    }
    
    public function ciudad() {
        return $this->ciudades[$this->ciudad];
    }
    
    // public function getCiudadAttribute($ciudad){
    //     return $this->ciudades[$ciudad];
    // }

    public function alquilado() {
        $alquileres = Alquiler::select('id','fecha_entrega','fecha_devolucion');
        $estado = '<span class="badge badge-success">Disponible</span>';
        $hoy = Carbon::today();

        foreach ($alquileres as $alquiler) {
            if ($hoy->between($alquiler->fecha_entrega, $alquiler->fecha_devolucion ) ) {
                $estado = '<span class="badge badge-danger">Alquilado</span>';
            }
        }
        return $estado;
    }

    public function getVtoRtoAttribute() {
        return Carbon::parse($this->attributes['vto_rto'])->format('Y-m-d') ;
    }
    public function getVtoSeguroAttribute() {
        return Carbon::parse($this->attributes['vto_seguro'])->format('Y-m-d') ;
    }
    public function getVtoHabilitacionAttribute() {
        return Carbon::parse($this->attributes['vto_habilitacion'])->format('Y-m-d') ;
    }

    
}
