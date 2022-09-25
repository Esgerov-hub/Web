<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("notification_id");
            $table->unsignedBigInteger("user_id");

            $table->foreign('notification_id')->references("id")->on("notifications")->onDelete('cascade');
            $table->foreign('user_id')->references("id")->on("users")->onDelete('cascade');

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
        Schema::dropIfExists('notifications_users');
    }
}
