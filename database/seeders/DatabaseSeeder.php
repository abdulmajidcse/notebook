<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // add admin
        Admin::create([
            'name'              => 'Administrator',
            'email'             => 'admin@gmail.com',
            'password'          => Hash::make(12345678),
        ]);
    }
}
