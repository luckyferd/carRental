<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table='cars';
    protected $primaryKey = 'cars_id';


    protected $fillable=['cars_name', 'car_type', 'description', 'car_status', 'car_photo', 'price'];

    public function carType()
{
    return $this->belongsTo(CarType::class, 'car_type', 'type_id');
}
}
