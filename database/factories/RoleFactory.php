<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    private $roles = ['super admin', 'admin', 'author'];

    function roles()
    {
        $var = array_shift($this->roles);
        array_push($this->roles, $var );
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
            'role' => $this->roles()
        ];
    }
}
