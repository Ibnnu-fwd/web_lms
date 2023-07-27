<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'admin',
            'email'    => 'admin@mail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'gender'   => 'L',
            'birthday' => date('Y-m-d'),
            'role'     => 1,
            'status'   => 1
        ]);
    }
}
