<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFnsLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('login_fns', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('username')->comment('Логин пользователя');
		    $table->string('password')->comment('Пароль пользователя');
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
	    Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('fns_logins');
    }
}
