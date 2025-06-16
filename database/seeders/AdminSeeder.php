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
        $user = User::create([
            'firstname' => 'Thomas',
            'lastname' => 'Bariselli',
            'email' => 'thomas.bm2003@gmail.com',
            'password' => 'password123',//hash::make('aaaa')
        ]);
        $user->assignRole('admin');
        $user1 = User::create([
            'firstname' => 'Angelo',
            'lastname' => 'Costi',
            'email' => 'costi@gmail.com',
            'password' => 'password123',//hash::make('aaaa')
        ]);
        $user1->assignRole('teacher');
    }
}
