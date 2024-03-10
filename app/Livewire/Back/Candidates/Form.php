<?php

namespace App\Livewire\Back\Candidates;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

class Form extends Component
{
    public $title;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $company;
    public $postal_code;
    public $cdt_status;
    public $position_id;
    public $positions;
    public $candidate;
    public $created_by;
    public $candidateTitles;
    public $autorizeAddCandidate = true;
    public $action;
    public function mount()
    {
        $this->candidateTitles = Helper::candidateTitles();
        $this->positions = Position::orderBy('name', 'asc')->get();
        if ($this->candidate && $this->candidate->exists) {
            $this->title = $this->candidate->title;
            $this->first_name = $this->candidate->first_name;
            $this->last_name = $this->candidate->last_name;
            $this->email = $this->candidate->email;
            $this->phone = $this->candidate->phone;
            $this->company = $this->candidate->company;
            $this->postal_code = $this->candidate->postal_code;
            $this->cdt_status = $this->candidate->cdt_status;
            $this->position_id = $this->candidate->position_id;
        }
    }

    public function updated($field)
    {
        $this->checkExistingCandidate();
    }
    public function checkExistingCandidate()
    {
        if (!empty($this->position_id)) {
            $existingCandidate = Candidate::when($this->first_name, function ($query) {
                $query->where('first_name', $this->first_name);
            })
                ->when($this->last_name, function ($query) {
                    $query->where('last_name', $this->last_name);
                })
                ->when($this->email, function ($query) {
                    $query->where('email', $this->email);
                })
                ->when($this->phone, function ($query) {
                    $query->where('phone', $this->phone);
                })
                ->when($this->company, function ($query) {
                    $query->where('company', $this->company);
                })
                ->when($this->postal_code, function ($query) {
                    $query->where('postal_code', $this->postal_code);
                })
                ->when($this->cdt_status, function ($query) {
                    $query->where('cdt_status', $this->cdt_status);
                })
                ->when($this->title, function ($query) {
                    $query->where('title', $this->title);
                })
                ->where('position_id', $this->position_id)

                ->exists();

            if ($existingCandidate) {
                $this->autorizeAddCandidate = false;
                if (!empty($this->first_name)) {
                    $this->addError('first_name', 'Ce candidat existe déjà.');
                }
                if (!empty($this->last_name)) {
                    $this->addError('last_name', 'Ce candidat existe déjà.');
                }
                if (!empty($this->phone)) {
                    $this->addError('phone', 'Ce candidat existe déjà.');
                }
                if (!empty($this->company)) {
                    $this->addError('company', 'Ce candidat existe déjà.');
                }
                if (!empty($this->postal_code)) {
                    $this->addError('postal_code', 'Ce candidat existe déjà.');
                }
                if (!empty($this->email)) {
                    $this->addError('email', 'Ce candidat existe déjà.');
                }
                if (!empty($this->cdt_status)) {
                    $this->addError('cdt_status', 'Ce candidat existe déjà.');
                }
                if (!empty($this->position_id)) {
                    $this->addError('position_id', 'Ce candidat existe déjà.');
                }
                if (!empty($this->title)) {
                    $this->addError('title', 'Ce candidat existe déjà.');
                }
            } else {
                $this->autorizeAddCandidate = true;
                $this->resetErrorBag(['first_name', 'last_name', 'email', 'phone', 'company', 'postal_code', 'cdt_status', 'position_id', 'title']);
            }
        }
    }

    public function storeData()
    {
        $data = $this->validate(
            [
                'title' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:candidates,email',
                'phone' => 'required',
                'company' => 'required',
                'postal_code' => 'required',
                'cdt_status' => 'required',
                'position_id' => 'required',
            ],
            [
                'title.required' => 'Le titre est obligatoire',
                'first_name.required' => 'Le prénom est obligatoire',
                'last_name.required' => 'Le nom est obligatoire',
                'email.required' => 'L\'email est obligatoire',
                'email.email' => 'L\'email doit être une adresse email valide',
                'phone.required' => 'Le téléphone est obligatoire',
                'company.required' => 'La société est obligatoire',
                'postal_code.required' => 'Le code postal est obligatoire',
                'cdt_status.required' => 'Le statut est obligatoire',
                'position_id.required' => 'Le poste est obligatoire',
                'email.unique' => 'Cet email existe déjà. Veuillez en saisir un autre.',
            ],
        );
        DB::beginTransaction();
        $data['created_by'] = auth()->user()->id;
        $candidate = Candidate::create($data);
        DB::commit();
        $this->reset(['title', 'first_name', 'last_name', 'email', 'phone', 'company', 'postal_code', 'cdt_status', 'position_id']);
        $this->dispatch('candidate-created-success');
        return redirect()->route('candidates.show', $candidate->id);
        try {
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: 'Une erreur s\'est produite lors de la création du candidat. Veuillez réessayer.');
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.form');
    }
}
