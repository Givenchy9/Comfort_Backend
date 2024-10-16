<?php

namespace Database\Factories;

use App\Models\Huis;
use Illuminate\Database\Eloquent\Factories\Factory;

class HuisFactory extends Factory
{
    protected $model = Huis::class;

    public function definition()
    {
        return [
            'straatnaam' => $this->faker->streetName,
            'postcode' => $this->faker->postcode,
            'huisnummer' => $this->faker->buildingNumber,
            'prijs' => $this->faker->randomFloat(2, 50000, 500000),
            'type' => $this->faker->randomElement(['koop', 'huur']),
            'oppervlakte_huis' => $this->faker->numberBetween(50, 300),
            'oppervlakte_tuin' => $this->faker->numberBetween(10, 150),
            'plaats' => $this->faker->city,
            'provincie' => $this->faker->state,
            'slaapkamers' => $this->faker->numberBetween(1, 6),
            'badkamers' => $this->faker->numberBetween(1, 3),
            'woonlagen' => $this->faker->numberBetween(1, 3),
            'energie_label' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'isolatie' => $this->faker->randomElement(['Volledig geïsoleerd', 'Gedeeltelijk geïsoleerd', 'Geen']),
            'bouwjaar' => $this->faker->year,
            'garage' => $this->faker->randomElement(['ja', 'nee']),
            'zwembad' => $this->faker->randomElement(['ja', 'nee']),
            'tuin' => $this->faker->randomElement(['ja', 'nee']),
            'zonnepanelen' => $this->faker->randomElement(['ja', 'nee']),
        ];
    }
}