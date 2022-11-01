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
        //
        $categoris = Category::factory()->times(5)->create();
        // Category::factory()->create();

        foreach ($categoris as $category) {
            // $category->addMedia(storage_path('app\seeds\categories\\'. $category->category . '.jpg'))->toMediaCollection('categories');
            $category->addMedia(public_path('images\seeds\categories\\'. $category->category . '.jpg'))->toMediaCollection('categories');

        }


    }
}
