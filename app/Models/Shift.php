<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_plate',
        'owner_contact',
        'start_location',
        'start_time',
        'end_location',
        'end_time',
        'shift_code',
        'driver_id',
        'paid',
    ];
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }
}
