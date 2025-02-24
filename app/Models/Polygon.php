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
        'speed_limit',
        'isEnabled'
    ];
    public function points(){
        return $this->hasMany(Point::class,'polygon_id','id');
    }
}
