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

    public function oppLinks()
    {
        return $this->hasMany(OppMcpLink::class, 'mcp_id');
    }

    public function opportunities()
    {
        return $this->belongsToMany(Oppdashboard::class, 'opp_mcp_links', 'mcp_id', 'opp_id')
            ->withTimestamps();
    }

    public function cdtLinks()
    {
        return $this->hasMany(CdtMcpLink::class, 'mcp_id');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'cdt_mcp_links', 'mcp_id', 'cdt_id')
            ->withTimestamps();
    }
}


