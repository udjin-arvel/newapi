<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
	        $table->bigIncrements('id');
	
	        $table->string('type', 64);
	        $table->string('title')->nullable();
	        $table->text('text');
	
	        $table->unsignedBigInteger('content_id')->nullable();
	        $table->string('content_type')->nullable();
	
	        $table->unsignedBigInteger('user_id')->nullable();
	        $table->foreign('user_id')->references('id')->on('users');
	        
	        $table->unsignedSmallInteger('importance')->default(1);
	        $table->boolean('is_public')->default(false);
	        $table->timestamp('realized_at')->nullable();
	
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
        Schema::dropIfExists('descriptions');
    }
}
