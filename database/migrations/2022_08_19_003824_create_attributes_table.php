<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->json("name")->nullable();
            $table->boolean("status")->default(true);
            $table->integer("type")->default(0);
            // 0-attribute
            // 1-attribute group
            $table->unsignedBigInteger("group_id")->nullable();
            $table->foreign('group_id')->references("id")->on("attributes")->onDelete('cascade');
            $table->string('datatype')->default('string');
            // string
            // mm
            // qr
            // ml
            $table->integer("order")->default(1);

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
        Schema::dropIfExists('attributes');
    }
}
