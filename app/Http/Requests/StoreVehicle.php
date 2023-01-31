<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVehicle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
        'name' =>'required|max:255',
        'price' => 'required',
        'discount_price' => '',
        'production_year' => 'required|numeric',
        'kilometers' => 'required|numeric',
        'engine_type' =>'required|string',
        'chassis_type' => 'required|string',
        'gearbox' => 'required|string',
        'color' => 'required|string',
        'door_number' => 'nullable',
        'engine_volume' => 'required|numeric',
        'engine_strength' => 'required|numeric',
        'drive' => 'nullable|string',
        'opis' => 'nullable|string',
        'vehicle_model_id' =>'nullable|integer',
        'thumbnail' => 'required|image',
        ];
        if($this->method() === 'POST'){
            $rules['thumbnail'] = 'required|image';
        }
        else if($this->method() === 'PUT'){
            $rules['thumbnail'] = 'image';
        } 
        return $rules;
            
    }
}