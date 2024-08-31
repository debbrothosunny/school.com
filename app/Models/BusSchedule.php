<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id', 'bus_number', 'route_name', 'driver_name', 'start_time',
        'end_time', 'start_location', 'end_location', 'days_of_operation',
        'capacity', 'contact_number', 'status', 'remarks'
    ];

    public function class()
    {
        return $this->belongsTo(ClassName::class);
    }
}
