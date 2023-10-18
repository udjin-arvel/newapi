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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->text('description');
            $table->string('character')->nullable();
            $table->string('ability')->nullable();
            $table->string('race')->nullable();
            $table->string('poster')->nullable();
            $table->float('birthday_eon')->nullable(); // макс. 21
            $table->float('power_level')->default(1); // макс. 21
            $table->boolean('is_public')->default(true);
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
