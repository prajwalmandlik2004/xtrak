<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['code_cdt', 'state', 'origine', 'commentaire', 'civ_id', 'first_name', 'last_name', 'email', 'phone', 'compagny_id', 'postal_code', 'cdt_status', 'created_by', 'position_id', 'phone_2', 'certificate', 'city', 'address', 'region', 'country', 'disponibility_id', 'url_ctc'];
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function disponibility()
    {
        return $this->belongsTo(Disponibility::class);
    }
    public function civ()
    {
        return $this->belongsTo(Civ::class);
    }
    public function compagny()
    {
        return $this->belongsTo(Compagny::class);
    }
    public function files()
    {
        return $this->hasMany(File::class, 'owner_id', 'id');
    }
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }
    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }
    public function auteur()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
