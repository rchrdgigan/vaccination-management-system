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
            $table->string('family_no');
            $table->date('date_of_registration');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('childs_name');
            $table->string('gender');
            $table->string('mothers_name');
            $table->string('fathers_name');
            $table->double('birth_height');
            $table->double('birth_weight');
            $table->string('address');
            $table->timestamps();

            $table->foreignId('barangay_id')->nullable()->constrained()->cascadeOnDelete();

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
