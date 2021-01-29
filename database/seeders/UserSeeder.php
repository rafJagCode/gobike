<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'email'=> 'test@gmail.com',
            'password'=>Hash::make('test123'),
        ]);
        DB::table('users')->insert([
            'email'=> 'test1@gmail.com',
            'password'=>Hash::make('test123'),
        ]);
        DB::table('users')->insert([
            'email'=> 'pracownik@gmail.com',
            'password'=>Hash::make('test123'),
            'account_type'=>'staff'
        ]);
    }
}
