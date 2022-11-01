<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserFactory extends Factory
{


    private $names = ['Jhon Wick', 'Kate Amber', 'Warran White'];
    private $email = ['jhon@gmail.com', 'kate@gmail.com', 'warran@gmail.com'];
    private $username = ['jhon', 'kate ', 'warran'];
    private $role_id = [1, 2, 3];



    public function names()
    {
        $var = array_shift($this->names);
        array_push($this->names, $var );
        return $var;
    }
    public function email()
    {
        $var = array_shift($this->email);
        array_push($this->email, $var );
        return $var;
    }
    public function username()
    {
        $var = array_shift($this->username);
        array_push($this->username, $var );
        return $var;
    }
    public function role_id()
    {
        $var = array_shift($this->role_id);
        array_push($this->role_id, $var );
        return $var;
    }
    
    
    

    
    /**
     
     * Define the model's default state.
     
     *
     * @return array
     */
    public function definition()
    {
        /* return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]; */

        return [
            'name' => $this->names(),
            'username' => $this->username(),
            'role_id' => $this->role_id(),
            'email' => $this->email(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
