<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'logo' => 'default.jpg',
            "name"=> "Zaky",
            'username' =>'admin',
            'email'=> 'zaky7645@gmail.com',
            'password'=> bcrypt('123'),
            'role'=> 'admin',
        ]);
    }
}