<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert(
            [
                'name' => 'Clients Grant',
                'secret' => config('passport.client.secret'),
                'provider' => 'clients',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'revoked' => 0,
                'password_client' => 1
            ]
        );

        DB::table('oauth_clients')->insert(
            [
                'name' => 'Masters Grant',
                'secret' => config('passport.master.secret'),
                'provider' => 'masters',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'revoked' => 0,
                'password_client' => 1
            ]
        );
    }
}
