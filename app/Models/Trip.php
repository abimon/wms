<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_plate',
        'passenger_contact',
        'location',
        'direction',
    ];
    public function tripReport(){
        return $this->hasMany(TripReport::class,'trip_id','id');
    }
}
