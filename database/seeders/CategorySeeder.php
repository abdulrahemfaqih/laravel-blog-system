<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Programing', 'slug' => 'programing'],
            ['name' => 'Sosial', 'slug' => 'sosial'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan']
        ];

        DB::table('categories')->insert($data);
    }
}
