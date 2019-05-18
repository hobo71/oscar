<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(VehiculoTableSeeder::class);
        $this->call(AlquilerTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(OptionsTableSeeder::class);

    }
}
