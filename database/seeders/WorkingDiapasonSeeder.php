<?php

namespace Database\Seeders;

use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Database\Seeder;

class WorkingDiapasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkingDiapason::factory(50)->create();
    }
}
