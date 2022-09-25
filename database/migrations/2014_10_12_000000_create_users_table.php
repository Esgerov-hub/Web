<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->text("photo")->nullable();
            $table->string('name_surname');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('type')->default(1);
            // 1-user
            // 2-admin
            // 3-teacher
            // 4-company
            $table->boolean('verify')->default(false);
            $table->string("referal_code")->unique();
            $table->text("signature")->nullable();
            // Imza Sertifikat ucun lazimdir
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
