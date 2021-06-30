<?php
    
    use App\Models\Player;
    use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
        
            $table->unsignedBigInteger('user_id');
            $table->string('login', 64)->default(Player::DEFAULT_LOGIN);
            $table->string('status', 24)->default(Player::STATUS_USER);
            $table->string('poster', 64)->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('city', 64)->nullable();
            $table->text('info')->nullable();
        
            $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('player_id')->nullable();
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_player_id_foreign');
            $table->dropColumn('player_id');
        });
        
        Schema::dropIfExists('players');
    }
}
