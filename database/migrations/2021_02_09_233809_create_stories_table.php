<?php
    
    use App\Models\Story;
    use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            $table->string('title');
            $table->unsignedSmallInteger('chapter')->nullable();
            $table->text('epigraph')->nullable();
            $table->unsignedTinyInteger('eon')->nullable();
            $table->boolean('is_published')->default(false);
            $table->string('type', 64)->default(Story::TYPE_STORY);
            
            $table->unsignedBigInteger('composition_id')->nullable();
            $table->foreign('composition_id')->references('id')->on('compositions');
    
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
        Schema::dropIfExists('stories');
    }
}
