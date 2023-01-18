<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function model(){
        return $this->belongsTo('App\Models\VehicleModel', 'vehicle_model_id');
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function equipment(){
        return $this->belongsToMany(Equipment::class);
    }
}
