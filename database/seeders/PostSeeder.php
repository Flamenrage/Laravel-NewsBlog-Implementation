<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Post::factory(Post::class, 100)->create();
        \App\Models\Post::factory()->times(100)->create();

    }
}
