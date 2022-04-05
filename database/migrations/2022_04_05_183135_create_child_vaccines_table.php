<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_vaccines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('vaccine_id');
            $table->dateTime('inj_1st_date');
            $table->dateTime('inj_2st_date');
            $table->dateTime('inj_3st_date');
            $table->text('has_inj_1st_dose')->default(0);
            $table->text('has_inj_2st_dose')->default(0);
            $table->text('has_inj_3st_dose')->default(0);
            $table->timestamps();

            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_vaccines');
    }
};
