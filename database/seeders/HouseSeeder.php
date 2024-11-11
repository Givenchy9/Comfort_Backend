<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 40; $i++) {
            DB::table('huizen')->insert([
                'straatnaam' => fake('nl_NL')->streetName,
                'postcode' => fake('nl_NL')->postcode,
                'huisnummer' => fake('nl_NL')->buildingNumber,
                'prijs' => fake()->randomFloat(2, 100000, 1000000),
                'type' => fake()->randomElement(['koop', 'huur']),
                'oppervlakte_huis' => fake()->numberBetween(50, 300),
                'oppervlakte_tuin' => fake()->optional()->numberBetween(20, 100),
                'plaats' => fake('nl_NL')->city,
                'provincie' => fake('nl_NL')->state,
                'slaapkamers' => fake()->numberBetween(1, 6),
                'badkamers' => fake()->numberBetween(1, 3),
                'woonlagen' => fake()->numberBetween(1, 4),
                'energie_label' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G']),
                'isolatie' => fake()->optional()->randomElement(['spouwmuur', 'dakisolatie', 'vloerisolatie']),
                'bouwjaar' => fake()->year,
                'garage' => fake()->randomElement(['ja', 'nee']),
                'zwembad' => fake()->randomElement(['ja', 'nee']),
                'tuin' => fake()->randomElement(['ja', 'nee']),
                'zonnepanelen' => fake()->randomElement(['ja', 'nee']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
