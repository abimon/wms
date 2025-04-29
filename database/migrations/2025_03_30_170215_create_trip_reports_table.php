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
        Schema::create('trip_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->double('speed_limit')->nullable();
            $table->string('speed')->nullable();
            $table->string('start_time');
            $table->string('start_location');
            $table->string('direction');
            $table->string('accuracy');
            $table->string('end_time')->nullable();
            $table->string('end_location')->nullable();
            $table->timestamps();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_reports');
    }
};
