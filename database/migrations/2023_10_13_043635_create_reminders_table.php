<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            
            $table->string('title')->nullable();
            $table->text('text');
            $table->unsignedSmallInteger('order')->default(0);
            
            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');
            
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
