<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('services')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
	        DB::table('services')->insert([
	            'titulo' => $faker->sentence(2),
	            'fecha' =>$faker->dateTimeThisYear(),
                'vigencia' =>$faker->dateTimeThisYear(),
                'importe' =>$faker->randomFloat($nbMaxDecimals = 2, $min = 1000, $max = 10000),
	            'vehiculo_id' => rand(1, 20),
	            'detalle' => $faker->sentence(25),
	        ]);
        }
    }
}
