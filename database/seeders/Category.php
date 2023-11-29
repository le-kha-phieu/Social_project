<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Music'],
            ['name' => 'Sport'],
            ['name' => 'Love'],
            ['name' => 'Cook'],
            ['name' => 'Confide'],
        ]);
    }
}
