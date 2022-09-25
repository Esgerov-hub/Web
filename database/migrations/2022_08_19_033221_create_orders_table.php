<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
 
            $table->string("ipaddress");
            $table->string("uid")->unique();
            $table->string("order_number")->unique();
            // Sifaris nomresi basqa Uid Basqa Id basqa seydi
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');
            $table->integer("qyt")->default(1);
            $table->float("price")->default(0.0);
            $table->string("currency")->default("AZN");
            $table->boolean("status")->default(true);

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
        Schema::dropIfExists('orders');
    }
}
