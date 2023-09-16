<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sexe = ['Male','Female'];
        $sexeForSave = Arr::random($sexe);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'sexe' => $sexeForSave,
            'profileImg' => $sexeForSave == 'Male' ? 'profileUser/90d6234278f61977c4e9d2c34836c418.jpg' : 'profileUser/default-female-user-profile-icon-vector-illustration_276184-169.jpg',
            'password' => Hash::make('test1234'),
        ];
    }
}
