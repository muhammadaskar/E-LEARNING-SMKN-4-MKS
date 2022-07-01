<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = DB::table('users')->insert([
        //     'name' => 'Admin Askar',
        //     'email' => 'muhammadaskar74@gmail.com',
        //     'password' => Hash::make('*password123*'),
        //     'role' => 'admin',
        //     'gender' => 'L',
        //     'address' => 'Btn Pesona Alam Mas Blok E No 5'
        // ]);


        DB::table('admins')->insert([
            'user_id' => 1,
            'nik' => '123456',
        ]);
    }
}
