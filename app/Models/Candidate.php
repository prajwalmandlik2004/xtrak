<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'position',
        'email',
        'phone',
        'Company',
        'postal_code',
        'cdt_status',
        'created_by'
    ];
}
