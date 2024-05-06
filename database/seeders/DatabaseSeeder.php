<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "username" => "faqih3935",
            "name" => "abdul rahem faqih",
            "email" => "faqih261203@gmail.com",
            "password" => bcrypt("faqih261203")
        ]);

        User::factory(5)->create();



        Category::create([
            "name" => "Kesehatan",
            "slug" => "kesehatan"
        ]);
        Category::create([
            "name" => "Sosial",
            "slug" => "sosial"
        ]);
        Category::create([
            "name" => "Programing",
            "slug" => "programing"
        ]);

        Blog::factory(20)->create();


    }
}
