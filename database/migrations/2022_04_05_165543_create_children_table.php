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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barangay_id');
            $table->dateTime('date_of_registration');
            $table->dateTime('date_of_birth');
            $table->dateTime('place_of_birth');
            $table->string('childs_name');
            $table->string('gender');
            $table->string('mothers_name');
            $table->string('fathers_name');
            $table->double('birth_height');
            $table->double('birth_weight');
            $table->timestamps();

            $table->foreign('barangay_id')->references('id')->on('barangays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
};
