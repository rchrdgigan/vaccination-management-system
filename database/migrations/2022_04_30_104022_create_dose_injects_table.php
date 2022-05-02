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
        Schema::create('dose_injects', function (Blueprint $table) {
            $table->id();
            $table->string('dose');
            $table->text('has_inj')->default(0);
            $table->dateTime('inj_date')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->default('Normal');
            $table->timestamps();
            $table->foreignId('child_vaccine_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('dose_injects');
    }
};
