<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compositions', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            $table->string('title');
            $table->text('description');
            $table->string('poster')->nullable();
            $table->unsignedTinyInteger('era')->nullable();
            $table->unsignedTinyInteger('parent_id')->nullable();
            $table->string('type', 64);
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('level')->default(1);
            $table->unsignedSmallInteger('chapter')->nullable();
            
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
        Schema::dropIfExists('compositions');
    }
}
