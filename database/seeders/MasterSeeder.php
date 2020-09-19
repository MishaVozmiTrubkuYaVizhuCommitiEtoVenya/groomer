<?php

namespace Database\Seeders;

use App\Models\Swagger\v1\Master;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Master::factory()->count(50)->create();
    }
}
