<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VehiculoTableSeeder extends Seeder
{
    
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('vehiculos')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker::create();

        for( $i = 0 ; $i <20 ; $i ++){
            DB::table('vehiculos')->insert([
                'marca_id' => rand(1,11), 
                'modelo' => $faker->company, 
                'patente' => $faker->ean8, 
                'anio' => rand(1990,2018), 
                'clase' => rand(0,3), 
                'ciudad' => rand(0,5), 
                'puertas' => rand(3,6), 
                'color' => $faker->hexColor(),
                'vto_rto' => $faker->dateTimeThisYear(),
                'vto_seguro' => $faker->dateTimeThisYear(),
                'vto_habilitacion' => $faker->dateTimeThisYear()
                ]);
                


        }
                
    }
}
