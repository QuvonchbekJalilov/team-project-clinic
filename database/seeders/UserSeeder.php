<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'unique_id' => mt_rand(111111, 999999),
            'first_name' => 'Quvonchbek',
            'last_name' => 'Jalilov',
            'phone_number' => "+998935889114",
            'email' => 'quvonchbek@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
