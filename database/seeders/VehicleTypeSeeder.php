<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $types = [
            'Sedan',
            'Hatchback',
            'SUV',
            'Coupe',
            'Limuzina',
            'Minivan',
            'Kombi',
            'Test Type',
        ];

        foreach ($types as $type){
            $vehicleType = new VehicleType();
            $vehicleType->name = $type;
            $vehicleType->save();
        }
    }
}
