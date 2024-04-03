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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('certificate')->nullable();
            $table->string('code_cdt')->nullable();
            $table->string('url_ctc')->nullable();
            $table->longText('commentaire')->nullable();
            $table->string('origine')->nullable();
            $table->foreignUuid('compagny_id')->nullable()->references('id')->on('compagnies');
            $table->foreignUuid('candidate_statut_id')->nullable()->references('id')->on('candidate_statuts');
            $table->foreignUuid('disponibility_id')->nullable()->references('id')->on('disponibilities');
            $table->foreignUuid('civ_id')->nullable()->references('id')->on('civs');
            $table->foreignUuid('position_id')->nullable()->references('id')->on('positions');
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignUuid('candidate_state_id')->nullable()->references('id')->on('candidate_states');
            $table->foreignUuid('next_step_id')->nullable()->references('id')->on('next_steps');
            $table->date('ns_date')->nullable();
            $table->string('cre_ref')->nullable();
            $table->timestamp('cre_created_at')->nullable();
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
