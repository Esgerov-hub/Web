<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->string("type")->default("referal");
            // Referal
            // Refund
            // Balance Adding
            $table->float("price")->default(0.0);
            $table->string("currency")->default("AZN");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->integer("process")->default(1);
            // 1-Add Meblegi Elave Et
            // 2-Delete Meblegi Cixar
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
        Schema::dropIfExists('user_balances');
    }
}
