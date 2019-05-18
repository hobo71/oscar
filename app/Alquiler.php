<?php

namespace Camino;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alquiler extends Model
{
    protected $table = 'alquileres';
    protected $dates = ['fecha_entrega', 'fecha_devolucion'];
    protected $fillable = ['vehiculo_id','fecha_entrega','fecha_devolucion','hora_entrega','hora_devolucion','servicio','forma_pago','descuento','vip','observaciones', 'lugar_entrega', 'lugar_devolucion','cotizacion'];

    // protected $dateFormat = 'd/m/Y';
    
    // relations
    public function vehiculo() {
        return $this->belongsTo('Camino\Vehiculo');
    }
    public function cliente() {
        return $this->belongsTo('Camino\Cliente');
    }

    public function getFechaEntregaAttribute() {
        return Carbon::parse($this->attributes['fecha_entrega'])->format('Y-m-d') ;
    }
    public function getFechaDevolucionAttribute() {
        return Carbon::parse($this->attributes['fecha_devolucion'])->format('Y-m-d') ;
    }

    // getters
    public function getServicioAttribute() {
        if( is_string($this->attributes['servicio'])){
            return $this->attributes['servicio'];
        } else {
            $servicios = ['Senda','Despegar','Otro','Pagina web'];
            return $servicios[$this->attributes['servicio']];
        }
    }

    public function getFormaPagoAttribute() {
        if( is_string($this->attributes['forma_pago'])){
            return $this->attributes['forma_pago'];
        } else {
            $pagos =  ['Efectivo','Tarjeta','Cheque', 'Transferencia','Deposito','A Credito', 'PayU'];
            return $pagos[$this->attributes['forma_pago']];
        }
    }

    public function itinerario() {
        return '<i class="fa fa-btn fa-angle-right"></i> <strong>'. $this->fecha_entrega->format('d/m/y') .' '.($this->hora_entrega ?  $this->hora_entrega . 'hs ' : '').'</strong> - '. $this->lugarBadge() .'<br>'.
               '<i class="fa fa-btn fa-angle-left"></i> <strong>'. $this->fecha_devolucion->format('d/m/y').' '.($this->hora_devolucion ?  $this->hora_devolucion . 'hs ' : '').'</strong> - '.  $this->lugarBadge("d");
    }

    public function itinerarioHuman() {
        return '<i class="fa fa-btn fa-angle-right"></i> Desde el <strong>'. $this->fecha_entrega->format('d/m/y') .($this->hora_entrega ? ' a las ' . $this->hora_entrega . 'hs ' : '').'</strong> en '. $this->lugarBadge() .'<br>'.
               '<i class="fa fa-btn fa-angle-left"></i> Hasta el <strong>'. $this->fecha_devolucion->format('d/m/y').($this->hora_devolucion ? ' a las ' . $this->hora_devolucion . 'hs ' : '').'</strong> en '.  $this->lugarBadge("d");
    }

    public function itinerarioInline() {
        return 'Desde el <strong>'. $this->fecha_entrega->format('d/m/y')  .($this->hora_entrega ? ' a las ' . $this->hora_entrega . 'hs ' : '').'</strong> en '. $this->lugarBadge() . ' hasta el <strong>'. $this->fecha_devolucion->format('d/m/y') .($this->hora_devolucion ? ' a las ' . $this->hora_devolucion . 'hs ' : '').'</strong> en '.  $this->lugarBadge("d");
    }

    public function estado() {
        $hoy = Carbon::today();
        
        if ($hoy->between($this->fecha_entrega, $this->fecha_devolucion ) ) {
            $estado = '<span class="badge badge-warning">En curso</span>';
        }  
        elseif ($this->fecha_devolucion->isPast() ) {
            $estado = '<span class="badge bg-faded text-muted">Finalizado</span>';
        } 
        elseif ($this->fecha_entrega->isFuture()) {
            $estado = '<span class="badge badge-info">Próximo</span>';
        } 

        return $estado;
    }

    public function estadoClass() {
        $hoy = Carbon::today();
        
        if ($hoy->between($this->fecha_entrega, $this->fecha_devolucion ) ) {
            $estado = '';
        }  
        elseif ($this->fecha_devolucion->isPast() ) {
            $estado = '0.65; background-color: #f8f8f8;';
        } 
        elseif ($this->fecha_entrega->isFuture()) {
            $estado = '';
        } 

        return $estado;
    }

   





}
