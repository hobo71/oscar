<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('marcas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
    	      
        DB::table('marcas')->insert(['nombre' => 'Volkswagen' ]);
        DB::table('marcas')->insert(['nombre' => 'Ford' ]);
        DB::table('marcas')->insert(['nombre' => 'Chevrolet' ]);
        DB::table('marcas')->insert(['nombre' => 'Fiat' ]);
        DB::table('marcas')->insert(['nombre' => 'Nissan' ]);
        DB::table('marcas')->insert(['nombre' => 'Audi' ]);
        DB::table('marcas')->insert(['nombre' => 'Renault' ]);
        DB::table('marcas')->insert(['nombre' => 'Toyota' ]);
        DB::table('marcas')->insert(['nombre' => 'Hyundai' ]);
        DB::table('marcas')->insert(['nombre' => 'Mitsubishi' ]);
        DB::table('marcas')->insert(['nombre' => 'Citroen' ]);
        DB::table('marcas')->insert(['nombre' => 'Geely' ]);
        DB::table('marcas')->insert(['nombre' => 'Lifan' ]);
        DB::table('marcas')->insert(['nombre' => 'Chery' ]);
        DB::table('marcas')->insert(['nombre' => 'Foton' ]);
        DB::table('marcas')->insert(['nombre' => 'DFM' ]);
        DB::table('marcas')->insert(['nombre' => 'JMC' ]);
        DB::table('marcas')->insert(['nombre' => 'Zotye' ]);
        DB::table('marcas')->insert(['nombre' => 'Brillance' ]);
        DB::table('marcas')->insert(['nombre' => 'DFSK' ]);
        DB::table('marcas')->insert(['nombre' => 'Baic' ]);
        DB::table('marcas')->insert(['nombre' => 'Haval' ]);
        DB::table('marcas')->insert(['nombre' => 'Great Wall' ]);
        

    }
}
