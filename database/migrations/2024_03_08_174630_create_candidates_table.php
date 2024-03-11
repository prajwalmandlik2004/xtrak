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
            $table->enum('title', ['Mr', 'Mme', 'Mlle'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('availability')->nullable();
            $table->string('company')->nullable();
            $table->string('postal_code')->nullable();
            $table->enum('cdt_status', ['Open', 'Close', 'In Progress']);
            $table->string('certificate')->nullable();
            $table->string('url_ctc')->nullable();
            $table->foreignUuid('position_id')->nullable()->references('id')->on('positions');
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
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
