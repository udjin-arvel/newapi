<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdminMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admin_menu')->insert([
            'order' => 2,
            'title' => 'Tags',
            'icon'  => 'fa-tags',
            'uri'   => '/tags',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('admin_menu')->where('title', 'Tags')->delete();
    }
}
