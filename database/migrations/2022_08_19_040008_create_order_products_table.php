<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("element_id");
            $table->string("type")->default("product");
            // Product
            // Product Package 3 deneli 5 deneli meselesi
            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id')->references("id")->on("orders")->onDelete('cascade');

            $table->json("product");
            // Product Haqqinda Hershey
            // Qiymeti
            // Adi
            // Sekli ve s.

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
        Schema::dropIfExists('order_products');
    }
}
