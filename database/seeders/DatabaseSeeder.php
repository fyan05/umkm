<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\category;
use App\Models\member;
use App\Models\order;
use App\Models\produk;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
                User::create([
            'name'=> 'Admin',
            'email' =>'admin@gmail.com',
            'level' =>'Admin',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'name'=> 'Rista',
            'email' =>'Rista@gmail.com',
            'level' =>'Member',
            'password' => bcrypt('123'),
        ]);
        User::create([
            'name'=> 'Fyan',
            'email' =>'Fyan@gmail.com',
            'level' =>'Member',
            'password' => bcrypt('123'),
        ]);
        category::create([
            'name'=>'Asin',
        ]);
        category::create([
            'name'=>'Manis',
        ]);
          member::create([
            'users_id'=> 4,
            'name'=> 'Fyan',
            'gender'=>'L',
            'birthday' => '2000-10-11',
            'address'=>'singaparna',
            'number_phone'=>'082163250',
            'image'=>'logo.png'
        ]);
        member::create([
            'users_id'=> 3,
            'name'=> 'Rista',
            'gender'=>'p',
            'birthday' => '2000-10-11',
            'address'=>'singaparna',
            'number_phone'=>'082163250',
            'image' =>'logo.png'
        ]);
        produk::create([
            'name'=>'Rengginang',
            'price'=>15000,
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo pariatur minima aperiam saepe fuga voluptatem laborum aliquid nulla ipsa earum et quam, distinctio facilis quaerat veritatis? Quam blanditiis vel animi?',
            'image'=>'rg.jpg',
            'categories_id'=>1,
        ]);
        produk::create([
            'name'=>'Telor gabus manis',
            'price'=>16000,
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo pariatur minima aperiam saepe fuga voluptatem laborum aliquid nulla ipsa earum et quam, distinctio facilis quaerat veritatis? Quam blanditiis vel animi?',
            'image'=>'manis.jpg',
            'categories_id'=>2,
        ]);
    }
}
