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
	    Schema::create('fns_logins', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('user_id');
		    $table->foreign('user_id')->references('id')->on('users');
		    $table->string('username')->nullable()->comment('Логин пользователя');
		    $table->string('password')->nullable()->comment('Пароль пользователя');
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
