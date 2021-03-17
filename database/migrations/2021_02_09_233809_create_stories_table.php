<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            $table->string('title');
            $table->unsignedSmallInteger('chapter')->nullable();
            $table->text('epigraph')->nullable();
            $table->unsignedTinyInteger('eon')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_announce')->default(false);
            
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')->references('id')->on('books');
    
            $table->unsignedBigInteger('series_id')->nullable();
            $table->foreign('series_id')->references('id')->on('series');
    
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
    
            $table->softDeletes();
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
        Schema::dropIfExists('stories');
    }
}
