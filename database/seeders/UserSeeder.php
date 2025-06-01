<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'email'=>'admin@email.com',
            'password'=>'123456789',
            'is_admin'=>true
        ]);

        user::factory()->create([
            'email'=>'user@email.com',
            'password'=>'123456789',
        ]);
    }
}
