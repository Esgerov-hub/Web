<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_counts', function (Blueprint $table) {
            $table->id();
            $table->string("ipaddress");
            $table->unsignedBigInteger("element_id")->nullable();
            // Hansi Melumatin Id sidirse onu izliyecek
            $table->unsignedBigInteger("user_id")->nullable();
            // Hansisa Istifadeci Varsa Onun Id sini qeyd elesin Reklam xarakterli
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->string("url")->nullable();
            $table->string("type")->default("category");
            // Category
            // Product
            // Company
            // Teacher
            // About
            // TermsConditions
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
        Schema::dropIfExists('view_counts');
    }
}
