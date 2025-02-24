<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class trgdashboard extends Migration
{
    public function up()
    {
        Schema::create('trg_vue', function (Blueprint $table) {
            $table->string('creation_date');
            $table->string('company');
            $table->string('standard_phone');
            $table->string('postal_code_department');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('email');
            $table->string('mobile');
            $table->string('event_date');
            $table->string('type');
            $table->string('subject');
            $table->string('event_status');
            $table->string('comment_trg');
            $table->string('next_step');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trg_vue');
    }
}
