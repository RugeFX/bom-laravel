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
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->string('role_code');
            $table->foreign('role_code')->references('code')->on("roles")->onDelete("cascade");
            $table->string('menuitem_code');
            $table->foreign('menuitem_code')->references('code')->on("menuitems")->onDelete("cascade");
            $table->tinyInteger('view');    
            $table->tinyInteger('add');
            $table->tinyInteger('edit');
            $table->tinyInteger('delete');
            $table->tinyInteger('import');
            $table->tinyInteger('export');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
