<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
    
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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
