<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class oppdashboard extends Migration
{
    public function up()
    {
        Schema::create('opportunity_table', function (Blueprint $table) {
            $table->string('opportunity_date');
            $table->string('opp_code');
            $table->string('job_titles');
            $table->string('name');
            $table->string('postal_code_1');
            $table->string('site_city');
            $table->string('opportunity_status');
            $table->string('remarks');
            $table->string('trg_code');
            $table->string('total_paid');
        });
    }

    public function down()
    {
        Schema::dropIfExists('opportunity_table');
    }
}
