<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pv_patient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pv_doctor_id');
            $table->foreign('pv_doctor_id')->references('id')->on('pv_doctor')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('phone');
            $table->string('mb_id');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('height');
            $table->string('weight');
            $table->string('pain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pv_patient');
    }
};
