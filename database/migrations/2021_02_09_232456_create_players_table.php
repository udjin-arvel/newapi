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
            
            $table->unsignedSmallInteger('level')->default(1);
            $table->unsignedBigInteger('experience')->default(0);
        
            $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id')->nullable();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_player_id_foreign');
            $table->dropColumn('player_id');
        });
        
        Schema::dropIfExists('players');
    }
}
