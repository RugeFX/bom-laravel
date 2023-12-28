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
        Schema::create('fakItems', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->string('name');
            $table->string('bom_code');
            $table->foreign('bom_code')->references("bom_code")->on('boms')->onDelete('cascade');
            $table->string('plan_code');
            $table->foreign('plan_code')->references("plan_code")->on('plans')->onDelete('cascade');
            $table->enum('status',['Complete','Incomplete','In Rental','Lost']);
            $table->string('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fak_items');
    }
};
