<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'=>'Usmon',
            'last_name'=>'Ataboyev',
            'birthdate'=>time(),
            'email'=>'admin123@gmail.com',
            'password' => 'access'

        ]);
    }
}
//);
//);
//'birthdate');
//'email')->unique();
