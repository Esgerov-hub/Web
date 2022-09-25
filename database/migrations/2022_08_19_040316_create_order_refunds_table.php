<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_refunds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id')->references("id")->on("orders")->onDelete('cascade');

            $table->string("refund_reason");
            $table->boolean("status")->default(false);

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');

            $table->unsignedBigInteger("admin_id");
            $table->foreign('admin_id')->references("id")->on("users")->onDelete('cascade');

            $table->unsignedBigInteger("element_id")->nullable();
            $table->string("type");
            // Product
            // Package Product

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
        Schema::dropIfExists('order_refunds');
    }
}
