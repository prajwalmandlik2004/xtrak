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
        Schema::create('candidates', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->enum('title', ['Mr', 'Mme', 'Mlle']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('Company');
            $table->string('postal_code');
            $table->enum('cdt_status', ['Open', 'Close', 'In Progress']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
