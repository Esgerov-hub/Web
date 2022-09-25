<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->json("question_name");
            $table->json("quiz_description")->nullable();
            $table->json("variants");
            // Orders
            // Value
            // True? of False?

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references("id")->on("products")->onDelete('cascade');

            $table->integer("order")->default(1);
            $table->boolean("status")->default(true);

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
        Schema::dropIfExists('quiz_questions');
    }
}
