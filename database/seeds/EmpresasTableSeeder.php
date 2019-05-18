<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmpresasTableSeeder extends Seeder
{
    
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('empresas')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
    	
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
	        $fecha_top = $faker->dateTimeThisMonth($max = 'now') ;
	        DB::table('empresas')->insert([
	            'nombre' => $faker->company,
	            'domicilio' => $faker->streetAddress,
	            'cuit' => '20-30384708-9',
	            'celular' => $faker->e164PhoneNumber,
	            'telefono' => $faker->phoneNumber,
	            'email' => $faker->email,
	            'foto' => 'default.jpg',
	            'observaciones' => $faker->sentence(2),
	            ]);
        }
    }
}
