<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json("name")->nullable();
            $table->json("description")->nullable();
            $table->json("keywords")->nullable();
            $table->json("address")->nullable();
            $table->json("social_network")->nullable();
            $table->json("logos")->nullable();
            $table->json("urls")->nullable(); //site,app, api vsvs
            $table->json("keys")->nullable();
            // Api Keys - GoogleMaps, Facebook, GTAG,
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
        Schema::dropIfExists('settings');
    }
}
