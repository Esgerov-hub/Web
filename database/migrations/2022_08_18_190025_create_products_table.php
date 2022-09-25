<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("uid")->unique();
            // Api ucun lazimdir
            $table->text("image")->nullable();
            $table->text("preview_url")->nullable();
            $table->json("name")->nullable();
            // 1 dilde yazilacaq ama sen yenede o biri dillere eyni melumati yazassan gelecek ucun lazimdir
            $table->json("description")->nullable();
            // 1 dilde yazilacaq ama sen yenede o biri dillere eyni melumati yazassan
            $table->json("slogan")->nullable();
            // 1 dilde yazilacaq ama sen yenede o biri dillere eyni melumati yazassan
            $table->json("requirements")->nullable();
            // 1 dilde yazilacaq ama sen yenede o biri dillere eyni melumati yazassan
            $table->json("whatyoushalllearn")->nullable();
            // json olaraq alt ba alt olacaq izah elyecem bomba kimi bisey olacaq
            $table->unsignedBigInteger("category_id");
            $table->foreign('category_id')->references("id")->on("categories")->onDelete('cascade');

            $table->unsignedBigInteger("created_by");
//            $table->unsignedBigInteger("user_id");
            $table->foreign('created_by')->references("id")->on("users")->onDelete('cascade');
            // Kim yaradb o qeyd olunur (Mellim de olar, Shirket de)
            $table->float("price")->default(0.0);
            $table->float("action_price")->nullable();
            $table->string("currency")->default("AZN");
            $table->boolean("status")->default(true);
            $table->integer("type")->default(1);
            // Course
            // Quiz
            $table->integer("order")->default(1);
            $table->boolean("givecert")->default(true);
//            Certificate verirmi
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
        Schema::dropIfExists('products');
    }
}
