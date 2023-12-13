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
        Schema::create('bom_material', function (Blueprint $table) {
            $table->id();
            $table->string("item_code");
            $table->foreignId("bom_id")->constrained('boms')->onDelete('cascade');
            $table->foreign("item_code")->references("item_code")->on('materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bom_material_master');
    }
};
