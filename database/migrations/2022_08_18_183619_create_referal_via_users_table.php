<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferalViaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referal_via_users', function (Blueprint $table) {
            $table->id();
            $table->string("referal_code");
            // Hansi Referal Code la gelib
            $table->unsignedBigInteger("caller_user_id"); // Kime gelibler
            $table->unsignedBigInteger("come_user_id");  // Kim gelib
            $table->float("earn")->default(1.0);
            // Qazandigi Mebleg
            $table->string("earn_currency")->default("AZN");
            // Qazandigi Meblegin Valyuta deyeri
            $table->foreign('caller_user_id')->references("id")->on("users")->onDelete('cascade');
            $table->foreign('come_user_id')->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('referal_via_users');
    }
}
