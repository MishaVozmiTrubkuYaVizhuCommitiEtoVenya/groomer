<?php

namespace Database\Seeders;

use App\Models\Swagger\v1\WorkingDiapazon;
use Illuminate\Database\Seeder;

class WorkingDiapazonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkingDiapazon::factory(50)->create();
    }
}
