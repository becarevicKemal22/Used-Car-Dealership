<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleModel>
 */
class VehicleModelFactory extends Factory
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

    public function peugeot308(){
        return $this->state(function(array $attributes){
            return [
                'name' => '308',
            ];
        });
    }

    public function peugeot4008(){
        return $this->state(function(array $attributes){
            return [
                'name' => '4008',
            ];
        });
    }

    public function renaultClio(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'Clio',
            ];
        });
    }

    public function mercedesS320(){
        return $this->state(function(array $attributes){
            return [
                'name' => 'S 320',
            ];
        });
    }
}
