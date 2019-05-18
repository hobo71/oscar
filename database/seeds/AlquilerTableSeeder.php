<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AlquilerTableSeeder extends Seeder
{
    
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	DB::table('alquileres')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker::create();
    	foreach (range(1,100) as $index) {

	        $fecha = $faker->dateTimeThisMonth() ;
	        //$fecha_nueva = Carbon::create($fecha);

	        DB::table('alquileres')->insert([
	            'cliente_id' => $faker->numberBetween($min = 1, $max = 100),
	            'vehiculo_id' => $faker->numberBetween($min = 1, $max = 20),
	            'empresa_id' => $faker->numberBetween($min = 1, $max = 50),
	            'user_id' => $faker->numberBetween($min = 1, $max = 5),
	            'fecha_entrega' => $fecha,
	            'fecha_devolucion' => $fecha,
	            'lugar_entrega' => $faker->numberBetween($min = 0, $max = 8),
	            'lugar_devolucion' => $faker->numberBetween($min = 0, $max = 8),
	            'servicio' => $faker->numberBetween($min = 0, $max = 2),
	            'forma_pago' => $faker->numberBetween($min = 0, $max = 2),
	            'cotizacion' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 8000) ,
	            'extras' => '' ,
	            'descuento' => rand(1, 25) ,
	            'vip' => rand(0, 1) ,
	            'sena' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 8000) ,
	            'sena_fecha' => $faker->dateTimeThisMonth()  ,
	            'sena_forma_pago' => $faker->numberBetween($min = 0, $max = 2),
	            'observaciones' => $faker->paragraph(1) 
	        ]);
        }

    }
}
