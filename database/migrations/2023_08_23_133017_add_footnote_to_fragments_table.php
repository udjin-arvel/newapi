<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFootnoteToFragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fragments', function (Blueprint $table) {
            $table->text('footnote')->nullable()->after('text')->comment('Авторская сноска');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fragments', function (Blueprint $table) {
            $table->dropColumn('footnote');
        });
    }
}
