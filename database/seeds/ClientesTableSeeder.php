<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('clientes')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $faker = Faker::create();
    	foreach (range(1,100) as $index) {
	        $fecha_top = $faker->dateTimeThisMonth($max = 'now') ;
	        DB::table('clientes')->insert([
	            'nombre' => $faker->firstName,
	            'apellido' => $faker->lastName,
	            'dni' => $faker->ean8,
	            'domicilio' => $faker->streetAddress,
	            'domicilio_temporal' => $faker->streetAddress,
	            'empresa_id' => $faker->numberBetween($min = 1, $max = 29),
	            'celular' => $faker->e164PhoneNumber,
	            'telefono' => $faker->phoneNumber,
	            'email' => $faker->email,
	            'foto' => 'default.jpg',
	            'vip' => $faker->numberBetween($min = 0, $max = 1),
	            'observaciones' => $faker->sentence(1),
	        ]);
        }
    }
}
