<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
	
	        $table->unsignedBigInteger('story_id');
	        $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
	
	        $table->unsignedBigInteger('fragment_id');
	        $table->foreign('fragment_id')->references('id')->on('fragments')->onDelete('cascade');
	
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
        Schema::dropIfExists('bookmarks');
    }
}
