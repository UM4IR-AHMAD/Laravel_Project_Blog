<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public $categories = ['interior', 'travel', 'food', 'lifeStyle', 'decorate'];

    public function getCategory()
    {
        $var = array_shift($this->categories);
        array_push($this->categories, $var );
        return $var;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'category' => $this->getCategory(),
        ];
    }
}
