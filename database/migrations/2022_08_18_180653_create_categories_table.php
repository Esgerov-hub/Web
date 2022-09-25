<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("uid")->unique();
            // Api ucun lazimdir
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->text("image")->nullable();
            $table->text("icon")->nullable();
            // Text for SVG ICONS
            $table->unsignedBigInteger("top_id")->nullable();
            $table->integer("order")->default(1);
            $table->boolean("active")->default(true);
            $table->string("type")->default("product");
            // Product
            // Blogs
            $table->json("slugs")->nullable();

            $table->foreign('top_id')->references("id")->on("categories")->onDelete('cascade');

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
        Schema::dropIfExists('categories');
    }
}
