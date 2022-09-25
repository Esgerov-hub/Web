<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')->references("id")->on("categories")->onDelete('cascade');
            $table->integer('status')->default(1)->nullable();
            $table->integer('active')->default(1)->nullable();
            $table->text('image');
            $table->json("title")->nullable();
            $table->json("slug")->nullable();
            $table->json("description")->nullable();
            $table->text("url");
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
        Schema::dropIfExists('projects');
    }
}
