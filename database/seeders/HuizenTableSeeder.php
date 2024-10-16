<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Huis;

class HuizenTableSeeder extends Seeder
{
    public function run()
    {
        Huis::factory()->count(10)->create();
    }
}