<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manufacturer_id', 'vehicle_type_id'];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleType(){
        return $this->belongsTo(VehicleType::class);
    }
}
