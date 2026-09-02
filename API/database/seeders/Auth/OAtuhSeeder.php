<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OAtuhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('oauth_clients')->insert([
            'id' => '9e0f33a0-4381-4055-8ca3-ce011ec3df7b',
            'user_id' => null,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'LxxypJcre0trUTijUTks9z4R9QtFw0zhB06J7I6r',
            'provider' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
