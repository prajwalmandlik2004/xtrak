<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trgdashboard extends Model
{
    protected $table = 'trg_vue';

    protected $fillable = [
        'creation_date',
        'company',
        'standard_phone',
        'postal_code_department',
        'title',
        'first_name',
        'last_name',
        'position',
        'email',
        'mobile',
        'event_date',
        'type',
        'subject',
        'event_status',
        'comment_trg',
        'next_step'
    ];
}





