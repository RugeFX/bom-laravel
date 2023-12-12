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
        Schema::create('bom_material_master', function (Blueprint $table) {
            $table->id();
            $table->integer("quantity");
            $table->string("item_code");
            $table->string("bom_code");
            $table->foreign("bom_code")->references("bom_code")->on('boms')->onDelete('cascade');
            $table->foreign("item_code")->references("item_code")->on('material_master')->onDelete('cascade');
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
