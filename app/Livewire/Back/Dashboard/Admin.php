<?php

namespace App\Livewire\Back\Dashboard;

use App\Models\User;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\CandidateState;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\CandidateStatut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CandidateRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $nbPaginate = 30;
    public $candidate_statut_id = '';
    public $candidateStatuses;
    public $filterName = '';
    public $filterDate = '';
    public $candidate_state_id = '';
    public $selectedCandidateId;
    public $candidateStates;
    public $positions;
    public $position_id;
    public $users_id;
    public $users;
    public $cp;
    public $sortColumn = 'last_name';
    public $sortDirection = 'desc';
    public $checkboxes = [];
    public $selectAll = false;
    public $created_by;
    public $certifiedCandidatesCount;
    public $uncertifiedCandidatesCount;

    public function selectCandidate($id, $page)
    {
        $this->selectedCandidateId = $id;
        session(['dash_base_cdt_selected_candidate_id' => $id]);
        session(['dash_base_cdt_current_page' => $page]);
        session(['dash_base_cdt_nb_paginate' => $this->nbPaginate]);
        return redirect()->route('candidates.show', $id);
    }
    public function selectCandidateGoToCre($id, $page)
    {
        $this->selectedCandidateId = $id;
        session(['base_cdt_selected_candidate_id' => $id]);
        session(['base_cdt_current_page' => $page]);
        session(['base_cdt_nb_paginate' => $this->nbPaginate]);
        return redirect()->route('candidate.cre', $id);
    }
    public function selectCandidateGoToCv($id, $page)
    {
        $this->selectedCandidateId = $id;
        session(['base_cdt_selected_candidate_id' => $id]);
        session(['base_cdt_current_page' => $page]);
        session(['base_cdt_nb_paginate' => $this->nbPaginate]);
        return redirect()->route('candidate.cv', $id);
    }
    #[On('delete')]// modified
    public function deleteData($id)
    {
        $candidateRepository = new CandidateRepository();
        DB::beginTransaction();
    
        try {
            foreach($id as $idc){ // $id is an array
                $candidate = $candidateRepository->find($idc);
                $candidateRepository->delete($candidate->id);
            }
            
            DB::commit();
            $this->dispatch('alert', type: 'success', message: "Les candidats sont supprimés avec succès" );
            $this->checkboxes = [];
            $this->selectAll = false;

        } catch (\Throwable $th) {
            DB::rollBack();
            $ids = implode(', ', $id);
    
            $this->dispatch('alert', type: 'error', message: "Impossible de supprimer les candidats");
        }
        /*
        }else
        {
            $candidate = $candidateRepository->find($id);
            try {
                $candidateRepository->delete($candidate->id);
                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'le candidat est supprimé avec succès');
            } catch (\Throwable $th) {
                DB::rollBack();
                $this->dispatch('alert', type: 'error', message: "Impossible de supprimer le candidat $candidate->first_name. $candidate->laste_name");
            }
        }
        */
    }

    public function updatedSelectAll($value)
{
    if ($value) {
        // If the select all box is checked, check all checkboxes
        $this->checkboxes = Candidate::pluck('id')->toArray();
    } else {
        // If the select all box is unchecked, uncheck all checkboxes
        $this->checkboxes = [];
    }
}
    public function sortBy($column)
    {
        $this->sortDirection = $this->sortColumn === $column
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
    
        $this->sortColumn = $column;
    }
    public function searchCandidates()
    {
        \Log::info('searchCandidates method called with search: ' . $this->search);
        $searchFields = ['first_name', 'last_name', 'email', 'phone', 'city', 'address', 'region', 'country'];
    
        return Candidate::with(['position', 'disponibility', 'civ', 'compagny', 'speciality', 'field', 'auteur'])
            ->where(function ($query) use ($searchFields) {
                $query
                    ->where(function ($query) use ($searchFields) {
                        foreach ($searchFields as $field) {
                            $query->orWhere($field, 'like', '%' . $this->search . '%');
                        }
                    })
                    ->orWhereHas('disponibility', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('civ', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('compagny', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('speciality', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('field', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('auteur', function ($query) {
                        $query->where('trigramme', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->filterName, function ($query) {
                return $query->orderBy('last_name', $this->filterName);
            })
            ->when($this->filterDate, function ($query) {
                return $query->orderBy('created_at', $this->filterDate);
            })
            ->when($this->candidate_state_id, function ($query) {
                $query->where('candidate_state_id', $this->candidate_state_id);
            })
            ->when($this->candidate_statut_id, function ($query) {
                $query->where('candidate_statut_id', $this->candidate_statut_id);
            })
            ->when($this->position_id, function ($query) {
                $query->where('position_id', $this->position_id);
            })
            ->when($this->users_id, function ($query) {
                $query->where('created_by', $this->users_id);
            })
            ->when($this->cp, function ($query) {
                $query->where('postal_code', 'like', '%' . $this->cp . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->nbPaginate);
    }
    
    
    public function confirmDelete($nom, $id)
    {
        $this->dispatch('swal:confirm', title: 'Suppression', text: "Vous-êtes sur le point de supprimer le candidat $nom", type: 'warning', method: 'delete', id: $id);
    }

     //
     public function confirmDeleteChecked($id)
     {
         $idsArray = explode(",", $id); // transform the string set passed by JS into an array
         //idsString = implode(", ", $idsArray);
         $this->dispatch('swal:confirm', title: 'Suppression', 
         text: "Vous-êtes sur le point de supprimer le(s) candidat(s) séléctionné(s)", type: 'warning', method: 'delete', id: $idsArray);
        
     }
     //

    public function mount()
    {
        $this->positions = Position::all();
        $this->candidateStatuses = CandidateStatut::all();
        $this->candidateStates = CandidateState::all();
        $this->users = User::all();
        $this->certifiedCandidatesCount = $this->countCertifiedCandidates();
        $this->uncertifiedCandidatesCount = $this->countUncertifiedCandidates();

        if (session()->has('dash_base_cdt_selected_candidate_id')) {
            $this->selectedCandidateId = session('dash_base_cdt_selected_candidate_id');
        }

        if (session()->has('dash_base_cdt_current_page')) {
            $this->setPage(session('dash_base_cdt_current_page'));
        }
        if (session()->has('dash_base_cdt_nb_paginate')) {
            $this->nbPaginate = session('dash_base_cdt_nb_paginate');
        }
    }
    public function downloadExcel()
    {
        try {
            $candidates = Candidate::with(['position', 'nextStep', 'disponibility', 'civ', 'compagny', 'speciality', 'field', 'auteur', 'cres', 'candidateStatut', 'candidateState', 'nsDate'])->get();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $headers = ['Source', 'CodeCDT', 'Auteur', 'Civ', 'Prénom', 'Nom', 'Poste', 'Spécialité', 'Domaine', 'Société', 'Mail', 'Tél1', 'Tél2', 'UrlCTC', 'CP/Dpt', 'Ville', 'Région', 'Disponibilité', 'Statut CDT', 'NextStep', 'NSDate'];
            $sheet->fromArray([$headers], null, 'A1');
            $row = 2;
            foreach ($candidates as $candidate) {
                $rowData = [$candidate->source ?? '', $candidate->code_cdt ?? '', $candidate->auteur->trigramme ?? '', $candidate->civ->name ?? '', $candidate->first_name ?? '', $candidate->last_name ?? '', $candidate->position->name ?? '', $candidate->speciality->name ?? '', $candidate->field->name ?? '', $candidate->compagny->name ?? '', $candidate->email ?? '', $candidate->phone ?? '', $candidate->phone2 ?? '', $candidate->url_ctc ?? '', $candidate->postal_code ?? '', $candidate->city ?? '', $candidate->region ?? '', $candidate->disponibility->name ?? '', $candidate->candidateStatut->name ?? '', $candidate->nextStep->name ?? '', $candidate->nsDate->name ?? ''];
                $sheet->fromArray([$rowData], null, 'A' . $row);
                $row++;
            }
            $writer = new Xlsx($spreadsheet);
            $fileName = 'base_candidats.xlsx';
            $writer->save($fileName);
            $this->dispatch('alert', type: 'success', message: 'Base candidats, exporter avec succèss');
            return response()->download($fileName)->deleteFileAfterSend(true);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('alert', type: 'error', message: "Une erreure est survenu, veuillez réessayez ou contacter l'administrateur");
        }
    }
    public function resetFilters()
    {
        $this->search = '';
        $this->filterName = '';
        $this->filterDate = '';
        $this->candidate_state_id = '';
        $this->candidate_statut_id = '';
        $this->position_id = '';
        $this->users_id = '';
    }
    public function countCertifiedCandidates()
    {
        return Candidate::whereHas('candidateState', function ($query) {
            $query->where('name', 'Certifié');
        })->count();
    }
    public function countUncertifiedCandidates()
{
    return Candidate::whereHas('candidateState', function ($query) {
        $query->where('name', 'Attente');
    })->count();
}
    public function render()
{
    $users = User::all();

    return view('livewire.back.dashboard.admin')->with([
        'candidates' => $this->searchCandidates(),
        'users' => $users,
    ]);
}
}
