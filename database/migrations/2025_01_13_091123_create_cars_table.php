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
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('cars_id');
            $table->string('cars_name', 50);
            $table->unsignedBigInteger('car_type');
            $table->foreign('car_type')
            ->references('type_id')
            ->on('car_types')
            ->onDelete('cascade');
            
            $table->text('description');
            $table->enum('car_status', ['ready', 'not ready']);
            $table->string('car_photo')->nullable();
            $table->decimal('price',10,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
