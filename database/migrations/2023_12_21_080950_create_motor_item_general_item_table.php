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
        Schema::create('motorItem_generalItem', function (Blueprint $table) {
            $table->string('general_code')->unique();
            $table->foreign('general_code')->references('code')->on('generalItems')->onDelete('cascade');
            $table->string('code');
            $table->foreign('code')->references('code')->on('motorItems')->onDelete('cascade');
            // $table->foreignId('motorItem_id')->constrained('motorItems')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorItem_generalItem');
    }
};
