<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['title', 'first_name', 'last_name', 'email', 'phone', 'company', 'postal_code', 'cdt_status', 'created_by', 'position_id', 'phone_2'];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function files()
    {
        return $this->hasMany(File::class, 'owner_id','id');
    }
}
