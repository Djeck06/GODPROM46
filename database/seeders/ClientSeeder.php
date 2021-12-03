<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = User::firstOrCreate([
            'email' => 'user@mail.me'
        ], [
            'first_name' => 'Client',
            'last_name' => 'Client',
            'password' => Hash::make('password'),
            'type' => 'client',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $user->client()->create();
    }
}
