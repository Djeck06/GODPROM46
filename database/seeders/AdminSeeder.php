<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate([
            'email' => 'godwin.elitcha@gmail.com'
        ], [
            'name' => 'Godwin Elitcha',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'status' => 'active',
            'role' => 'superadmin'
        ]);
    }
}
