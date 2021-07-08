<?php

use App\Models\Notion;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notions', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            $table->string('title');
            $table->text('text');
            $table->string('type', 64)->default(Notion::TYPE_DEFINITION);
            $table->string('poster')->nullable();
            $table->boolean('is_published')->default(false);
            $table->unsignedSmallInteger('level')->default(1);
            
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('notions');
    }
}
