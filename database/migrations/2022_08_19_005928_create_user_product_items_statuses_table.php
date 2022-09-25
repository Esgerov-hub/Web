<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProductItemsStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_product_items_statuses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references("id")->on("products")->onDelete('cascade');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');

            $table->unsignedBigInteger("element_id");
            // Quiz or ProductLesson
            $table->string("type")->default("product");
            // Product
            // Quiz

            $table->float("status_of_prouct_item")->default(0.0);
            // Dersin yada Quizin nece faizinin tamamlanması o daki belə olacaq verilmiş cavablara (Quiz) görə (say) faiz
            // Derslerin baxilma deqiqesi (via ajax)

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
        Schema::dropIfExists('user_product_items_statuses');
    }
}
