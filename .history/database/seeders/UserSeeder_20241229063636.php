<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'sara',
            'email'=>'aa496012772@gmail.com',
            'password'=>Hash::make('123456'),
        ]);

        User::create([
            'name'=>'nour',
            'email'=>'aa24375610@gmail.com',
            'password'=>Hash::make('123456'),
        ]);
    }
}
