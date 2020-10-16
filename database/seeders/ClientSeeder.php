<?php

namespace Database\Seeders;

use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Master;
use App\Models\Swagger\v1\Service;
use App\Models\Swagger\v1\WorkingDiapason;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = Client::create(
            [
                'type' => round(rand(0, 1)),
                'name' => "Рога и копыта",
                'image' => "",
                'settings' => json_encode(
                    [
                        'address' => 'Воронеж, ул. Урывского, 27',
                        'phone' => '+79019931763',
                        'website' => 'groomer.ru',
                        'email' => 'client@groomer.ru',
                        'timezone' => '+3',
                        'buttons' => [
                            'tg' => ['icon' => '', 'url' => 'https://t.me/fox_renard'],
                            'wa' => ['icon' => '', 'url' => ''],
                            'email' => ['icon' => '', 'url' => 'mailto:admin@groomer.ru'],
                        ],
                        'coords' => [
                            'lat' => '51.673315',
                            'lang' => '39.294245'
                        ]
                    ]
                ),
                'email' => 'email@email.test',
                'password' => Hash::make('password')
            ]
        );

        $client->masters()->saveMany(
            Master::factory(5)->create()->each(
                function ($master) {
                    $master->name = "Олег Иванов";

                    $wdMap = new \DateTime();
                    $wdMap->setTime(8, 0, 0);

                    $master->workingDiapasons()->saveMany(
                        WorkingDiapason::factory(50)->create(
                            [
                                'master_id' => $master->id
                            ]
                        )->each(
                            function ($wd) use ($wdMap) {
                                if (intval($wdMap->format('H')) > 19) {
                                    $wdMap->modify('+1 day');
                                    $wdMap->setTime(8, 0, 0);
                                }
                                $wd->time_start = $wdMap->format('Y-m-d H:i:s');
                                $wdMap->modify('+45 min');
                            }
                        )
                    );
                }
            )
        );

        $client->services()->saveMany(
            Service::factory(round(rand(3, 8)))->create(
                [
                    'client_id' => $client->id,
                    'name' => "Название услуги"
                ]
            )
        );
        /*
        Client::factory(3)->create()->each(
            function ($client) {
                $client->masters()->saveMany(
                    Master::factory(3)->create()->each(
                        function ($master) {
                            $master->workingDiapasons()->saveMany(
                                WorkingDiapason::factory(50)->create()
                            );
                        }
                    )
                );
                $client->promotions()->saveMany(
                    Promotion::factory(5)->create()
                );
                $client->services()->saveMany(
                    Service::factory(20)->create()
                );
            }
        );
        */
    }
}
