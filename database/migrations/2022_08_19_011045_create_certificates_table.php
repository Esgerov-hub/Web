<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Baxilacaq
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            // Sertifikatin adi
            $table->text("text");
            //product_id
//            user_id
//             Sertificat qalsin ona baxmaq lazimdi

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
        Schema::dropIfExists('certificates');
    }
}
