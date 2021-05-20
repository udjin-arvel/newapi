<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign('subscriptions_author_id_foreign');
            $table->dropForeign('subscriptions_book_id_foreign');
            $table->dropForeign('subscriptions_series_id_foreign');
            
            $table->dropColumn('book_id');
            $table->dropColumn('series_id');
            $table->dropColumn('author_id');
            
            $table->string('subscription_type', 64);
            $table->unsignedBigInteger('subscription_id');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('subscription_type');
            $table->dropColumn('subscription_id');
    
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
    
            $table->unsignedBigInteger('series_id')->nullable();
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
    
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
