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
        Schema::table('pv_patient', function (Blueprint $table) {
            $table->unsignedBigInteger('files_processed_id');
            $table->foreign('files_processed_id')
                ->references('id')
                ->on('files_processed')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pv_patient', function (Blueprint $table) {
            //
        });
    }
};
