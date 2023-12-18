<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bom_material', function (Blueprint $table) {
            $table->string('item_code');
            $table->foreign('item_code')->references('item_code')->on('materials')->onDelete('cascade');
            $table->foreignId('bom_id')->constrained('boms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_bom');
    }
};
