<?php

namespace App\Livewire\Back\Cres;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
class Show extends Component
{
    public $candidate;

    public function generatePdf()
    {
        $cres = $this->candidate->cres;
        $candidate = $this->candidate;

        $pdf = PDF::loadView('livewire.back.cres.pdf', compact('cres', 'candidate'));

        return Response::streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'cres_' . $candidate->first_name . '_' . $candidate->last_name . '.pdf');
    }
    public function render()
    {
        $cres = $this->candidate->cres;
        return view('livewire.back.cres.show')->with([
            'cres' => $cres,
        ]);
    }
}
