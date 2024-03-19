<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Supplier;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//use Admin

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Supplier::create([
        //     'name' => 'Win Kyaw',
        //     'email' => 'winkyaw@gmail.com',
        //     'photo' => '1.png',
        //     'slug' => 'hello',
        //     'password' => Hash::make('password'),
        // ]);
         Category::factory(10)->create();
         Brand::factory(10)->create();
         Color::factory(10)->create();
         Product::factory(10)->create();




        
    }
}
