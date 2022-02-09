<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        //membuat seeder manual
        // User::create([
        //     'name' => 'Gilang Maulana',
        //     'email' => 'gilang123@gmail.com',
        //     'password' => bcrypt('123')
        // ]);

        //  User::create([
        //     'name' => 'Hanna Athaya',
        //     'email' => 'hann.ath@gmail.com',
        //     'password' => bcrypt('123')
        // ]);


        //user
        User::factory(5)->create();
        
        // //category
        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
        ]);

        Category::create([
            'name' => 'Mobile Apps',
            'slug' => 'mobile-apps',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        //post
        Post::factory(25)->create();
        
    }
}
