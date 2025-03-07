<?php

namespace App\Livewire\Back\Oppdashboard;

// use App\Models\Ctcdashboard;
use App\Models\Oppdashboard;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';
    public $selectAll = false;
    public $hiredCount;
    public $inprogressCount;
    public $presentedCount;

    // Filter : 
    public $select = false;
    public $search = '';
    public $codeopp = '';
    public $libelle = '';
    public $company = '';
    public $statut = '';
    public $position = '';
    public $remarks = '';


    public $datas;
    public $selectedRows = [];
    protected $listeners = ['refreshTable' => '$refresh'];
    public $isEditing = false;
    public $editId = null;
    public $formData = [];
    public $step=1;
    public $action;

    public function refreshData()
    {
        $this->datas = Oppdashboard::latest()->get();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedRows = $this->data->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function toggleSelect($id)
    {
        if (in_array($id, $this->selectedRows)) {
            $this->selectedRows = array_diff($this->selectedRows, [$id]);
        } else {
            $this->selectedRows[] = $id;
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedRows)) {
            return;
        }

        Oppdashboard::whereIn('id', $this->selectedRows)->delete();
        $this->selectedRows = [];
        $this->selectAll = false;

        $this->refreshData();

        session()->flash('message', 'Data Deleted Successfully 🛑');
    }


    public function editRow($id)
    {
        $this->editId = $id;
        $item = Oppdashboard::find($id);

        if ($item) {
            $this->formData = $item->toArray();
            $this->isEditing = true;
        }
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editId = null;
        $this->formData = [];
    }

    public function updateForm()
    {
        // $this->validate([
        //     'formData.date_ctc' => 'required|date',
        //     'formData.ctc_code' => 'required',
        //     'formData.first_name' => 'required',
        //     'formData.last_name' => 'required',
        //     'formData.mail' => 'required|email',
        // ]);

        $item = Oppdashboard::find($this->editId);
        if ($item) {
            $item->update([
                'opportunity_date' => $this->formData['opportunity_date'] ?? null,
                'opp_code' => $this->formData['opp_code'] ?? null,
                'auth' => $this->formData['auth'] ?? null,
                'trg_code' => $this->formData['trg_code'] ?? null,
                'name' => $this->formData['name'] ?? null,
                'postal_code_1' => $this->formData['postal_code_1'] ?? null,
                'site_city' => $this->formData['site_city'] ?? null,
                'ctc1_code' => $this->formData['ctc1_code'] ?? null,
                'civs' => $this->formData['civs'] ?? null,
                'ctc1_first_name' => $this->formData['ctc1_first_name'] ?? null,
                'ctc1_last_name' => $this->formData['ctc1_last_name'] ?? null,
                'position' => $this->formData['position'] ?? null,
                'remarks' => $this->formData['remarks'] ?? null,
                'job_titles' => $this->formData['job_titles'] ?? null,
                'specificities' => $this->formData['specificities'] ?? null,
                'domain' => $this->formData['domain'] ?? null,
                'postal_code' => $this->formData['postal_code'] ?? null,
                'town' => $this->formData['town'] ?? null,
                'country' => $this->formData['country'] ?? null,
                'experience' => $this->formData['experience'] ?? null,
                'schooling' => $this->formData['schooling'] ?? null,
                'schedules' => $this->formData['schedules'] ?? null,
                'mobility' => $this->formData['mobility'] ?? null,
                'permission' => $this->formData['permission'] ?? null,
                'type' => $this->formData['type'] ?? null,
                'vehicle' => $this->formData['vehicle'] ?? null,
                'job_offer_date' => $this->formData['job_offer_date'] ?? null,
                'skill_one' => $this->formData['skill_one'] ?? null,
                'skill_two' => $this->formData['skill_two'] ?? null,
                'skill_three' => $this->formData['skill_three'] ?? null,
                'other_one' => $this->formData['other_one'] ?? null,
                'remarks_two' => $this->formData['remarks_two'] ?? null,
                'job_start_date' => $this->formData['job_start_date'] ?? null,
                'invoice_date' => $this->formData['invoice_date'] ?? null,
                'gross_salary' => $this->formData['gross_salary'] ?? null,
                'bonus_1' => $this->formData['bonus_1'] ?? null,
                'bonus_2' => $this->formData['bonus_2'] ?? null,
                'bonus_3' => $this->formData['bonus_3'] ?? null,
                'other_two' => $this->formData['other_two'] ?? null,
                'date_emb' => $this->formData['date_emb'] ?? null,
            ]);

            $this->isEditing = false;
            $this->editId = null;
            $this->formData = [];

            $this->refreshData();

            session()->flash('message', 'Form Updated Successfully ✅');
        }
    }



    public function resetFilters()
    {
        $this->select = false;
        $this->search = '';
        $this->codeopp = '';
        $this->libelle = '';
        $this->company = '';
        $this->statut = '';
        $this->position = '';
        $this->remarks = '';
    }
    public function mount()
    {
        $this->hiredCount = $this->countHired();
        $this->inprogressCount = $this->countInprogress();
        $this->presentedCount = $this->countPresented();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function countHired()
    {
        return Oppdashboard::where('opportunity_status', 'HIRED')->count();
    }

    public function countInprogress()
    {
        return Oppdashboard::where('opportunity_status', 'En cours')->count();
    }

    public function countPresented()
    {
        return Oppdashboard::where('opportunity_status', 'Presented')->count();
    }

    public function render()
    {
        $query = Oppdashboard::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('opportunity_date', 'like', '%' . $this->search . '%')
                    ->orWhere('opp_code', 'like', '%' . $this->search . '%')
                    ->orWhere('job_titles', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('postal_code_1', 'like', '%' . $this->search . '%')
                    ->orWhere('site_city', 'like', '%' . $this->search . '%')
                    ->orWhere('opportunity_status', 'like', '%' . $this->search . '%')
                    ->orWhere('remarks', 'like', '%' . $this->search . '%')
                    ->orWhere('trg_code', 'like', '%' . $this->search . '%')
                    ->orWhere('total_paid', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->codeopp) {
            $query->where('opp_code', 'like', '%' . $this->codeopp . '%');
        }

        if ($this->libelle) {
            $query->where('job_titles', 'like', '%' . $this->libelle . '%');
        }

        if ($this->company) {
            $query->where('name', 'like', '%' . $this->company . '%');
        }

        if ($this->statut !== '') {
            if ($this->statut == 'Open') {
                $query->where('opportunity_status', 'Open');
            } else if ($this->statut == 'Closed') {
                $query->where('opportunity_status', 'Closed');
            } else if ($this->statut == 'Filled') {
                $query->where('opportunity_status', 'Filled');
            }
        }

        if ($this->position) {
            $query->where('postal_code_1', 'like', '%' . $this->position . '%');
        }

        if ($this->remarks) {
            $query->where('remarks', 'like', '%' . $this->remarks . '%');
        }


        // $data = Oppdashboard::orderBy($this->sortField, $this->sortDirection)
        //     ->paginate(100);

        $data = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate(100);


        if ($this->isEditing) {
            return view('livewire.back.oppform.edit');
        }

        return view('livewire.back.oppdashboard.admin', [
            'data' => $data
        ]);
    }
}
