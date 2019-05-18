<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marca_id')->nullable();
            $table->string('modelo')->nullable();
            $table->string('patente')->nullable();
            $table->integer('categoria')->nullable(); // add
            $table->integer('kilometros')->nullable();
            $table->integer('anio')->nullable();
            $table->integer('clase')->nullable();
            $table->integer('puertas')->nullable();
            $table->string('cubiertas')->nullable();
            $table->date('vto_seguro')->nullable();
            $table->date('vto_rto')->nullable();
            $table->date('vto_habilitacion')->nullable();
            $table->string('color')->nullable();
            $table->string('foto')->nullable();
            $table->text('observaciones')->nullable();
            
            // nuevo 
            $table->integer('ciudad')->default(1)->nullable(); // 1 rio grande, 2 tolhuin, 3 ushuaia, 4 buenos aires, 5 otra ciudad
            $table->integer('activo')->default(1);
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
        Schema::drop('vehiculos');
    }
}
