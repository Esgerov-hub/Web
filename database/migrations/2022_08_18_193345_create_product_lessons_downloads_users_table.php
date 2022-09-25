<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLessonsDownloadsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lessons_downloads_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("downloads_id");
            $table->foreign('downloads_id')->references("id")->on("product_lessons_downloads")->onDelete('cascade'); //Hansi Dersin File i

            $table->string("ipaddress");
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade'); //Hansi Istifadeci

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
        Schema::dropIfExists('product_lessons_downloads_users');
    }
}
