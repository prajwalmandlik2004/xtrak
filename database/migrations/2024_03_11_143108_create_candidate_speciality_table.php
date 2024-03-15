<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_speciality', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignUuid('candidate_id')
                ->references('id')
                ->on('candidates');
                $table
                ->foreignUuid('speciality_id')
                ->references('id')
                ->on('specialities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_speciality');
    }
};
