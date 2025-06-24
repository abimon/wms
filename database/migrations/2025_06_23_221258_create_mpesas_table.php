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
        Schema::create('mpesas', function (Blueprint $table) {
            $table->id();
            $table->string('TransactionType');
            $table->unsignedBigInteger('shift_id');
            $table->string('TransAmount');
            $table->string('MpesaReceiptNumber');
            $table->string('TransactionDate');
            $table->string('PhoneNumber');
            $table->string('response');
            $table->timestamps();
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpesas');
    }
};
