<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'Nama_user' => 'Operator',
            'email'     => 'operator@gmail.com',
            'password'  => Hash::make('operator123'),
            'role'      => 'operator',
        ]);
    }
}