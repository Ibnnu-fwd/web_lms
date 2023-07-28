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
        $users = [
            [
                'fullname' => 'admin',
                'email'    => 'admin@mail.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'gender'   => 'L',
                'birthday' => date('Y-m-d'),
                'role'     => 1,
                'status'   => 1
            ],
            [
                'fullname' => 'andi saputra',
                'email'    => 'andi@mail.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'gender'   => 'L',
                'birthday' => date('Y-m-d'),
                'role'     => 4,
                'status'   => 1
            ],
            [
                'fullname' => 'budi santoso',
                'email'    => 'budi@mail.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'gender' => 'L',
                'birthday' => date('Y-m-d'),
                'role' => 4,
                'status' => 1
            ]
        ];

        User::insert($users);
    }
}
