<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')->references("id")->on("categories")->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->integer('type')->default(1)->nullable();
            $table->integer('status')->default(1)->nullable();
            $table->text('image');
            $table->json("title")->nullable();
            $table->json("slug")->nullable();
            $table->json("description")->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
