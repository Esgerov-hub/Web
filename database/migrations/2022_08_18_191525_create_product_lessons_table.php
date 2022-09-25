<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lessons', function (Blueprint $table) {
            $table->id();
            $table->string("uid")->unique();

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references("id")->on("products")->onDelete('cascade');

            $table->text("preview")->nullable(); // PreviewLinks
            $table->json("name")->nullable(); // Lesson Name
            $table->json("description")->nullable(); // Lesson Name
            $table->float("minute")->default(0.0); // minute
            $table->text("video")->nullable(); // VideoLink
            $table->integer("order")->default(1);
            $table->boolean("status")->default(true);
            $table->boolean("nextquiz")->default(false); // Soraki derse kecmey ucun quiz vermelisen
            $table->unsignedBigInteger("quiz_id")->nullable(); // Hansi Quiz olacaq kecse
            $table->foreign('quiz_id')->references("id")->on("products")->onDelete('cascade');

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
        Schema::dropIfExists('product_lessons');
    }
}
