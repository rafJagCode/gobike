<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name'=>'Kross Earth 4.0',
            'description'=>'Najlepszy rower pod słońcem',
            'price'=>10,
            'img'=>'kross',
            'availability'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Kross Earth 4.1',
            'description'=>'Najlepszy rower pod słońcem',
            'price'=>10,
            'img'=>'kross',
            'availability'=>true,
        ]);
        DB::table('products')->insert([
            'name'=>'Kross Earth 4.2',
            'description'=>'Najlepszy rower pod słońcem',
            'price'=>10,
            'img'=>'kross',
            'availability'=>true,
        ]);
    }
}
