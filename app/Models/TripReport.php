<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'speed_limit',
        'start_time',
        'start_location',
        'direction',
        'accuracy',
        'speed',
        'end_time',
        'end_location'
    ];
    public function trip(){
        return $this->belongsTo(Trip::class,'trip_id','id');
    }
}
