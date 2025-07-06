<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected  $table ='service_orders';
    protected $primaryKey='service_order_id';
    protected $fillable = ['customer_name',
        'email',
        'phone',
        'service_type',
        'service_date',
        'service_time',
        'vehicle_name',
        'additional_notes',
        'payment_methods',];

        public function serviceType()
    {
        return $this->belongsTo(Service::class, 'service_type', 'service_id');
    }
}
