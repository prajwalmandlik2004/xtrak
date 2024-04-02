<?php

namespace App\Livewire\Back\Cres;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $candidate;
    public function generatePdf()
    {
        $cres = $this->candidate->cres;
        $candidate = $this->candidate;
        $pdfName = 'CRE_' . $candidate->first_name . '_' . $candidate->last_name . '.pdf';
        $pdfContent = PDF::loadView('livewire.back.cres.pdf', [
            'cres' => $cres,
            'candidate' => $candidate,
        ])->output();
        return response()->streamDownload(fn() => print $pdfContent, $pdfName);
    }
    public function render()
    {
        $cres = $this->candidate->cres;
        return view('livewire.back.cres.show')->with([
            'cres' => $cres,
        ]);
    }
}
