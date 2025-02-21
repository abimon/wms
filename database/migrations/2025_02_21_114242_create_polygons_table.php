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
        Schema::create('polygons', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code");
            $table->string("point0");
            $table->string("point1")->nullable();
            $table->string("point2")->nullable();
            $table->string("point3")->nullable();
            $table->string("point4")->nullable();
            $table->string("point5")->nullable();
            $table->string("point6")->nullable();
            $table->string("point7")->nullable();
            $table->boolean("isEnabled")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polygons');
    }
};
