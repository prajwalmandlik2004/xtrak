<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class mcpdashboard extends Migration
{
    public function up()
    {
        Schema::create('mcp_vue', function (Blueprint $table) {
            $table->string('date_mcp');
            $table->string('mcp_code');
            $table->string('designation');
            $table->string('object');
            $table->string('tag_source');
            $table->string('message');
            $table->string('tool');
            $table->string('remarks');
            $table->string('notes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mcp_vue');
    }
}
