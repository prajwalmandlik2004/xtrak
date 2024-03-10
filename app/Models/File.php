<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $with = ['candidate'];
    protected $fillable = ['id', 'ref', 'name', 'path', 'owner_id', 'type', 'size', 'candidate_id'];
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
