<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

   public function run(): void
   {
    $users = [
        [
            'id' => 1,
            'name' => 'Majd',
            'email' => 'maged123@gmail.com',
            'password'=>'12345678',
        ],
        [
            'id' => 2,
            'name' => 'Khaled',
            'email' => 'Khaled123@gmail.com',
            'password'=>'12345678',
        ],
    ];

    foreach ($users as $user)
    {
        User::create($user);
    }
   }

}
