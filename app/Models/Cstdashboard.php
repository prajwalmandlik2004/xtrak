<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cstdashboard extends Model
{
    protected $table = 'cst_vue';

    protected $fillable = [
        'date_cst',
        'cst_code',
        'civ',
        'first_name',
        'last_name',
        'cell',
        'mail',
        'status',
        'notes',
    ];
}


