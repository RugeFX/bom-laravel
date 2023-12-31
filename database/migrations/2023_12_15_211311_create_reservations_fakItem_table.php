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
        Schema::create('reservations_fakItem', function (Blueprint $table) {
            $table->string('fak_code');
            $table->enum('status',['Complete','Incomplete','Lost'])->nullable();
            $table->foreign('fak_code')->references("code")->on('fakItems')->onDelete('cascade');
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations_fakItem');
    }
};
