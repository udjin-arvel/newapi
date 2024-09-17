<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loreitems', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('text');
            $table->string('poster')->nullable();
            $table->boolean('is_public')->default(false);
            $table->unsignedSmallInteger('level')->default(1);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loreitems');
    }
};
