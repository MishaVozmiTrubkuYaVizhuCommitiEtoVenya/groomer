<?php

namespace Database\Seeders;

use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Master;
use App\Models\Swagger\v1\Order;
use App\Models\Swagger\v1\Pet;
use App\Models\Swagger\v1\Promotion;
use App\Models\Swagger\v1\Service;
use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        //Client::factory(10)->create();
        //Master::factory(50)->create();
        //Order::factory(50)->create();
        //Pet::factory(50)->create();
        //Promotion::factory(50)->create();
        //Service::factory(50)->create();
        //WorkingDiapason::factory(50)->create();

        (new OAuthSeeder)->run();
        (new ClientSeeder)->run();
    }
}
