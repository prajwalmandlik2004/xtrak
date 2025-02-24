<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oppdashboard extends Model
{
    protected $table = 'opportunity_table';

    protected $fillable = [
        'opportunity_date',
        'opp_code',
        'job_titles',
        'name',
        'postal_code_1',
        'site_city',
        'opportunity_status',
        'remarks',
        'trg_code',
        'total_paid',
    ];
}
