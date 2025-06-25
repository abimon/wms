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
        Schema::create('shift_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shift_id');
            $table->string('start_time');
            $table->string('start_location');
            $table->string('direction');
            $table->string('accuracy');
            $table->string('end_time')->nullable();
            $table->string('speedLimit')->nullable();
            $table->string('highestSpeed')->nullable();
            $table->string('end_location')->nullable();
            $table->string('type')->default('speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_reports');
    }
};
