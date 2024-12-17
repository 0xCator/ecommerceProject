<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User; // Adjust the model name if necessary

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'admoon',
            'email' => 'admoon@admoon.admoon',
            'password' => Hash::make('1223334444'),
            'role' => 'admin',
        ]);
    }
}