<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{   use HasFactory;
    protected $table='booking_orders';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'customer_name',
        'email',
        'phone_number',
        'pick_up_location',
        'drop_location',
        'pickup_date',
        'pickup_time',
        'car',
        'request',
    ];
    public function pickUpLocation()
    {
        return $this->belongsTo(Location::class, 'pick_up_location', 'location_id');
    }
    public function dropLocation()
    {
        return $this->belongsTo(Location::class, 'drop_location', 'location_id');
    }
    public function carName()
    {
        return $this->belongsTo(Car::class, 'car', 'cars_id');
    }
}
