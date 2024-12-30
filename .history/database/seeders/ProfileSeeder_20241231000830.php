<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            'phone'=>'01002060168',
            'address'=>'mansoura',
            'date_of_birth'=>'1/10/2001',
            'bio'=>'Junior Backend Developer',
            'user_id'=>1,
        ]);


        Profile::create([
            'phone'=>'0105824789',
            'address'=>'cairo',
            'date_of_birth'=>'17/6/1999',
            'bio'=>'Accountant with 5 years of experience',
            'user_id'=>2,
        ]);
    }
}
