<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            // Subject
            $table->text("value");
            // Description
            $table->unsignedBigInteger("element_id")->nullable();
            // Hara isdedin notification gondere bilersen Post a Product a
            $table->string("type")->default("product");
            // Product
            // Campaigns
            // Validation
            // UserAndTeacherMessages -gelecekde
            // UserAndCompanyMessages -gelecekde
            // CompanyAndTeacherMessages -gelecekde
            // CompanyAndCompanyMessages -gelecekde  bizimle sirketin danisigi // gelecekdee
            $table->integer("via")->default(1);
            // 1-Email
            // 2-SMS
            // 3-EMail&SMS

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
        Schema::dropIfExists('notifications');
    }
}
