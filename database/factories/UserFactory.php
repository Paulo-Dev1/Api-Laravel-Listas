<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){

    
        return [
            /* 'name' =>' Silvio Santos',
            'email' =>'Silvio@Santos.com',
            'password' => Hash::make('12345')  */

            'name' => $this->faker->name,//criar nome aleatorio
            'email' =>$this->faker->unique()->safeEmail,// criar email aleatorio
            'password' => Hash::make('12345') // password 
        ];
    }
}
