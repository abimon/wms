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
    public function shiftReports(){
        return $this->hasMany(ShiftReport::class,'shift_id','id');
    }
}


// {
//     "whole":
//     {
//         "stkCallback":
//         {
//             "MerchantRequestID":"8a99-4a85-bcdd-4bc42eb7bc556075107",
//             "CheckoutRequestID":"ws_CO_24062025165805261701583807",
//             "ResultCode":1032,
//             "ResultDesc":"Request cancelled by user"
//         }
//     }
// }  
