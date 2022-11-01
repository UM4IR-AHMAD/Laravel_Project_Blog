<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoris = Category::factory()->times(5)->create();

        foreach ($categoris as $category) {
            $category->addMedia(public_path('images\seeds\categories\\'. $category->category . '.jpg'))->toMediaCollection('categories');

        }


    }
}
