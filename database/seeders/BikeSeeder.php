<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bike;

class BikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crea 200 motos
        Bike::factory(200)->create();
    }
}
