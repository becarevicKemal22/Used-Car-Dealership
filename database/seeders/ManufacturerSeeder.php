<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mercedes = Manufacturer::factory()->Mercedes()->create();
        $renault = Manufacturer::factory()->Renault()->create();
        $peugeot = Manufacturer::factory()->Peugeot()->create();
    }
}
