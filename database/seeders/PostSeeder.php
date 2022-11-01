<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::factory()->times(3)->create();
        $faker = \Faker\Factory::create();
        $url = "https://source.unsplash.com/random/1200x800";
        foreach ($posts as $post) {
            $post->addMediaFromUrl($url)->toMediaCollection('posts');
        }
        
    }
}
