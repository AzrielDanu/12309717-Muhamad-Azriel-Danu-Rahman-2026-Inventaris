<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'role' => 'admin',
            'password' => '123456'
        ]);

        User::create([
            'name' => 'staff',
            'email' => 'staff@email.com',
            'role' => 'staff',
            'password' => '123456'
        ]);

    }
}
