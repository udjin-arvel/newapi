<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blanks', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title');
            $table->text('text');
            $table->unsignedSmallInteger('importance')->default(1);
            $table->unsignedBigInteger('content_id')->nullable();
            $table->string('content_type')->nullable();
            
            $table->unsignedBigInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
            
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
        Schema::dropIfExists('blanks');
    }
}
