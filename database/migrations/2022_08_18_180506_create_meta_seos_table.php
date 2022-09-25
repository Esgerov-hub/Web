<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_seos', function (Blueprint $table) {
            $table->id();
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->json("keyword")->nullable();
            $table->string("type")->default("product");
            $table->unsignedBigInteger("element_id")->nullable();
            // About
            // Refund
            // TermsConditions
            // Product
            // Campaigns
            // Posts
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
        Schema::dropIfExists('meta_seos');
    }
}
