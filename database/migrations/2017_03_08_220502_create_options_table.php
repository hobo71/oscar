<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('theme_color')->nullable();
            $table->string('logo_iso')->nullable();
            $table->string('logo_logo')->nullable();
            $table->float('valor_auto_chico')->default(0);
            $table->float('valor_auto_mediano')->default(0);
            $table->float('valor_auto_grande')->default(0);
            $table->float('valor_camioneta')->default(0);
            $table->integer('descuento')->default(0);
            $table->integer('descuento_vip')->default(0);


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
        //
    }
}
