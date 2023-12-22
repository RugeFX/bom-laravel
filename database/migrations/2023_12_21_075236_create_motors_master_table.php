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
        Schema::create('motors_master', function (Blueprint $table) {
            $table->id();
            $table->string("item_code")->unique();
            $table->string("name");
            $table->integer("quantity");
            $table->string("master_code");
            $table->foreign("master_code")->references("master_code")->on('masters')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors_master');
    }
};
