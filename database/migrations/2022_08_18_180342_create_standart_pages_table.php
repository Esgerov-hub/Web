<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandartPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standart_pages', function (Blueprint $table) {
            $table->id();
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->string("bg_image")->nullable();
            $table->string("type");
            // About
            // Refundterms
            // DeliveryAndPayment
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
        Schema::dropIfExists('standart_pages');
    }
}
