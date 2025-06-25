<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'shift_id',
        'start_time',
        'start_location',
        'direction',
        'accuracy',
        'end_time',
        'speedLimit',
        'highestSpeed',
        'end_location',
        'type'
    ];
}
