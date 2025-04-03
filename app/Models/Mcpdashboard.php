<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcpdashboard extends Model
{
    protected $table = 'mcp_vue';

    protected $fillable = [
        'date_mcp',
        'mcp_code',
        'designation',
        'object',
        'tag_source',
        'message',
        'tool',
        'remarks',
        'notes',
    ];
}


