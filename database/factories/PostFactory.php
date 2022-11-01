<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class PostFactory extends Factory
{
    private $postsCount = 28;
    private $postsCount2 = 28;

 


    public function description()
    {
        $paragraphs = $this->faker->paragraphs(rand(2,20));
        $desc= '<p>';
        foreach ($paragraphs as $key => $para) {
            $desc .= '<p>' . $para . '</p>' ;
        }

        return $desc;
    }


    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence($nbWords = rand(2, 5), $variableNbWords = true),
            'description' => $this->description(),
            'category_id' => rand(1,5),
            'user_id' => rand(1, 3),
            'views' => rand(3,40),
        ];
    }
}
