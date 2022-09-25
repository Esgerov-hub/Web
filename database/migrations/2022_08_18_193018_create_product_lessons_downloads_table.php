<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLessonsDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lessons_downloads', function (Blueprint $table) {
            $table->id();
            $table->string("uid")->unique();

            $table->unsignedBigInteger("product_lesson_id");
            $table->foreign('product_lesson_id')->references("id")->on("product_lessons")->onDelete('cascade'); //Hansi ders

            $table->text("file");
            $table->boolean("status")->default(true);
            $table->string("name");
            $table->integer("order")->default(1);

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
        Schema::dropIfExists('product_lessons_downloads');
    }
}
