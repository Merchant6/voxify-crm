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
        Schema::create('doctor_form_physicians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('npi');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('number');
            $table->string('fax_number');
            $table->string('signature');
            $table->string('signed_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_form_physicians');
    }
};
