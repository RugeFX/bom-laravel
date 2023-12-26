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
        Schema::create('reservations_hardcaseitem', function (Blueprint $table) {
            $table->string('hardcase_code');
            $table->enum('status',['Lost','Scrab','Ready For Rent','Out Of Service'])->nullable();
            $table->foreign('hardcase_code')->references("code")->on('hardcaseItems')->onDelete('cascade');
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations_hardcaseitem');
    }
};
