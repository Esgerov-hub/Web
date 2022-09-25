<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuizResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_quiz_results', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references("id")->on("products")->onDelete('cascade');

            $table->unsignedBigInteger("quiz_question_id");
            $table->foreign('quiz_question_id')->references("id")->on("quiz_questions")->onDelete('cascade');

            $table->json("values");

            $table->float("status_result")->default(1);
            // Statusu 1- dise asagi surat
            // 2-biraz cenesi qalxan surat
            // 3-agzi duz surat
            // 4-gulumsenen surat
            // 5-hirildiyan surat

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
        Schema::dropIfExists('user_quiz_results');
    }
}
