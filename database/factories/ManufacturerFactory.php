<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function Peugeot(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'Peugeot',
            ];
        });
    }

    public function Mercedes(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'Mercedes',
            ];
        });
    }

    public function Renault(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'Renault',
            ];
        });
    }
}
