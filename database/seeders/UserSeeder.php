<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            //colum table db => value
            'id' => "1",
            'email' => "admin@gmail.com",
            'name' => "Admin",
            'role' => 'Admin',
            "password" => Hash::make("1234"),
            //cara lain ekpripsi : bcyrpt

        ]);
        User::create([
            //colum table db => value
            'id' => "2",
            'email' => "kasir@gmail.com",
            'name' => "Kasir",
            'role' => 'Kasir',
            "password" => Hash::make("1234"),
            //cara lain ekpripsi : bcyrpt

        ]);
    }
}
