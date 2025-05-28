<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'start_time',
        'start_location',
        'direction',
        'accuracy',
        'speedLimit',
        'end_time',
        'highestSpeed',
        'end_location'
    ];
    public function trip(){
        return $this->belongsTo(Trip::class,'trip_id','id');
    }
}
