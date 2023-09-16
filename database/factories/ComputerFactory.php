<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names = [
            'Envy', 'ThinkPad', 'Latitude', 'Surface', 'MacBook',
            'ZenBook', 'Swift', 'Inspiron', 'XPS', 'ProBook',
            'EliteBook', 'Ideapad', 'Yoga', 'Aspire', 'Pavilion',
            'VivoBook', 'Legion', 'Omen', 'Spectre', 'Vaio',
            'Predator', 'Alienware', 'Chromebook', 'Pixelbook', 'Portégé',
            'Latitude', 'Swift', 'Vostro', 'TravelMate', 'Helios'
        ];
        $pathImages = [
            'ComputersImages/51SxIHhQjbL._AC_UF1000,1000_QL80_.jpg',
            'ComputersImages/download.jpeg',
            'ComputersImages/images (1).jpeg',
            'ComputersImages/images.jpeg',
            'ComputersImages/pc_gaming_fullset_i5_rtx_2060__1649059293_3be0625e_progressive.jpg',
            'ComputersImages/pexels-bich-tran-1714341.jpg',
            'ComputersImages/photo-1626218174358-7769486c4b79.jpeg',
           ];
        return [
            'nameComputer' =>  Arr::random($names),
            'originComputer' => fake()->country(),
            'priceComputer' => fake()->numberBetween(199, 3999),
            'imageComputer' => Arr::random($pathImages),
            'user_id' => 3,
        ];
    }
}
