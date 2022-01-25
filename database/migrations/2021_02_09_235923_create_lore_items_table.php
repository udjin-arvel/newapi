<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoreItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lore_items', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            $table->string('title');
            $table->text('text');
            $table->string('poster')->nullable();
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('level')->default(1);
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->softDeletes();
	        $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lore_items');
    }
}
