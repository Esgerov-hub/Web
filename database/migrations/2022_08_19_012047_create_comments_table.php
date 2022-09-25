<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->string("uid")->unique();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->string("subject")->nullable();
            $table->text("content")->nullable();

            $table->unsignedBigInteger("top_id");
            $table->foreign('top_id')->references("id")->on("comments")->onDelete('cascade');

            $table->boolean("global")->default(false);

            $table->unsignedBigInteger("element_id");
            // Productid Campaign Id
            $table->string("type")->default("product");
            // Product
            // Campaign
            // Global Forms
            $table->integer("rating")->default(0);
            $table->boolean("status")->default(false);

            // Admin Accepter
            $table->unsignedBigInteger("admin_id");
            $table->foreign('admin_id')->references("id")->on("users")->onDelete('cascade');

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
        Schema::dropIfExists('comments');
    }
}
