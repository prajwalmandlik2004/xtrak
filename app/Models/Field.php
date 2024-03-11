<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = ['name', 'description'];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
}
