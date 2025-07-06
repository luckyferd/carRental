<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->string('customer_name', 50);
            $table->string('email',100);
            $table->string('phone_number',20);
            $table->unsignedBigInteger('pick_up_location');
            $table->foreign('pick_up_location')
            ->references('location_id')
            ->on('locations')
            ->onDelete('cascade');
            $table->unsignedBigInteger('drop_location');
            $table->foreign('drop_location')
            ->references('location_id')
            ->on('locations')
            ->onDelete('cascade');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->unsignedBigInteger('car');
            $table->foreign('car')
            ->references('cars_id')
            ->on('cars')
            ->onDelete('cascade');
            
            $table->text('request' );
            $table->enum('payment',['cash', 'qris', 'transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_orders');
    }
};
