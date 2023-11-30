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
        Schema::create('notion_params', function (Blueprint $table) {
            $table->id();
    
            $table->unsignedBigInteger('notion_id');
            $table->foreign('notion_id')->references('id')->on('notions');
    
            $table->string('title');
            $table->string('value');
    
            $table->unsignedInteger('order')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_params');
    }
};
