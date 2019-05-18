<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquileresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id');
            $table->integer('vehiculo_id');
            $table->integer('empresa_id');

            $table->integer('user_id');

            $table->date('fecha_entrega');
            $table->date('fecha_devolucion');
            $table->integer('lugar_entrega')->nullable();
            $table->integer('lugar_devolucion')->nullable();
            $table->integer('servicio')->nullable();
            $table->integer('forma_pago')->nullable();
            $table->string('extras')->nullable();
            $table->integer('descuento')->nullable();
            $table->float('cotizacion')->nullable();
            $table->integer('nro_factura')->nullable();
            $table->boolean('vip')->nullable();
            $table->text('observaciones')->nullable();

            $table->float('sena')->nullable()->default(0);
            $table->date('sena_fecha')->nullable();
            $table->integer('sena_forma_pago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alquileres');
    }
}
