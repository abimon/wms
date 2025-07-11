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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_plate');
            $table->string('owner_contact');
            $table->string('start_location');
            $table->string('start_time');
            $table->string('end_location')->nullable();
            $table->string('end_time')->nullable();
            $table->string('shift_code')->unique();
            $table->unsignedBigInteger('driver_id');
            $table->boolean('paid')->default(false);
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
