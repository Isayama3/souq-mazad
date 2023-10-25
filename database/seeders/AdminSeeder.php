<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factory::factoryForModel(Admin::class)->count(10)->create();

        Admin::create([
            'first_name' => "admin",
            'last_name' => "admin",
            'phone_number' => "01022334455",
            'email' => "admin@admin.com",
            'password' => '123456789', 
        ]);
    }
}
