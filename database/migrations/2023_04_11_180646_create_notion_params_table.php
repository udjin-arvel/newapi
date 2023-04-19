<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotionParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notion_params', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('notion_id');
            $table->foreign('notion_id')->references('id')->on('notions');

            $table->string('title');
            $table->string('value');

            $table->unsignedInteger('order')->default(0);

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
        Schema::dropIfExists('notion_params');
    }
}
