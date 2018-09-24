<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
        });

        Schema::create('urls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->text('url')->index();
            $table->string('hashid')->unique();
            $table->integer('impression')->default(0);
            $table->integer('created_by_id')->unsigned();

            $table->foreign('created_by_id')->references('id')->on('users');
        });

        Schema::create('analytics', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->index();
            $table->integer('impression')->default(0);
            $table->integer('url_id')->unsigned();

            $table->foreign('url_id')->references('id')->on('urls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytics');
        Schema::dropIfExists('urls');
        Schema::dropIfExists('users');
    }
}
