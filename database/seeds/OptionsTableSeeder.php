<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('options')->truncate();
    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		DB::table('options')->insert(array(
            'title' =>  'Senda Renting',
				'valor_auto_chico'	=>	800,
				'valor_auto_mediano'	=>	1200,
				'valor_auto_grande'	=>	1500,
				'valor_camioneta'	=>	2100,
				'descuento'	=>	5,
				'descuento_vip'	=>	20
			));
    }
}
