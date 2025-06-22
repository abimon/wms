<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_plate',
        'shift_code',
        'driver_id',
        'paid',
    ];
    public function driver(){
        return $this->belongsTo(User::class,'driver_id','id');
    }
}
