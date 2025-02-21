<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'point0',
        'point1',
        'point2',
        'point3',
        'point4',
        'point5',
        'point6',
        'point7',
        'isEnabled'

    ];
}
