<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('attachments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('message_id')->constrained()->onDelete('cascade');
        $table->string('file_path');
        $table->string('file_type');
        $table->integer('file_size');
        $table->timestamp('uploaded_at')->useCurrent();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachements');
    }
};
