<?php
    
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('login', 64)->default(User::DEFAULT_LOGIN);
            $table->string('status', 24)->default(User::STATUS_USER);
	        $table->unsignedSmallInteger('level')->default(1);
	        $table->unsignedBigInteger('experience')->default(0);
            $table->string('poster')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('city', 64)->nullable();
            $table->text('info')->nullable();
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
