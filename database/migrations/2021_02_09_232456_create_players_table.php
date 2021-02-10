<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
        
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    
            $table->string('login', 64)->default(\App\Models\Player::DEFAULT_LOGIN);
            $table->string('status', 24)->default(\App\Models\Player::STATUS_USER);
            $table->string('poster', 64)->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('city', 64)->nullable();
            $table->text('info')->nullable();
            $table->string('clan', 24)->nullable();
        
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
        Schema::dropIfExists('Player');
    }
}
