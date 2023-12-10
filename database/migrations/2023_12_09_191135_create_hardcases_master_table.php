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
        Schema::create('hardcases_master', function (Blueprint $table) {
            $table->id();
            $table->string("item_code")->unique();
            $table->string("name");
            $table->integer("quantity");
            $table->foreignId("master_id")->constrained("masters")->onDelete("cascade");
            $table->foreignId("color_id")->constrained('colors')->onDelete("cascade");
            $table->foreignId("size_id")->constrained('sizes')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardcases_master');
    }
};
