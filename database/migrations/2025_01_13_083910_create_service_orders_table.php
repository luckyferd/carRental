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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->bigIncrements('service_order_id');
            $table->string('customer_name',50);
            $table->string('email',50);
            $table->string('phone',20)->nullable();
            $table->unsignedBigInteger('service_type');
            $table->foreign('service_type')
            ->references('service_id')
            ->on('services')
            ->onDelete('cascade');
            $table->date('service_date');
            $table->time('service_time');
            $table->string('vehicle_name', 50);
            $table->text('additional_notes');
            $table->enum('payment_methods', ['cash', 'qris', 'bank_transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
