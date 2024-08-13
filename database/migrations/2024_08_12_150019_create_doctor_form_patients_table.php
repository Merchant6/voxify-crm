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
        Schema::create('doctor_form_patients', function (Blueprint $table) {
            $table->id();
            $table->string('order_date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('primary_insurance');
            $table->string('policy_number');
            $table->string('private_insurance');
            $table->string('private_insurance_number');
            $table->string('height');
            $table->string('width');
            $table->string('brace');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_form_patients');
    }
};
