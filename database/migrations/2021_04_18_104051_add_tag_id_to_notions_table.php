<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagIdToNotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notions', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')->after('text');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notions', function (Blueprint $table) {
            $table->dropForeign('notions_tag_id_foreign');
            $table->dropColumn('tag_id');
        });
    }
}
