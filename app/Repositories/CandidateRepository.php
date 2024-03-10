<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository
{
    public function all()
    {
        return Candidate::all();
    }

    public function find($id)
    {
        return Candidate::findOrFail($id);
    }

    public function create(array $data)
    {
        return Candidate::create($data);
    }

    public function update(array $data, $id)
    {
        $candidate = $this->find($id);
        $candidate->update($data);
        return $candidate;
    }

    public function delete($id)
    {
        $candidate = Candidate::find($id);
        return $candidate->delete();
    }
}
