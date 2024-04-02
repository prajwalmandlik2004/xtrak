<?php

namespace App\Livewire\Back\Cres;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Facades\Pdf;
class Show extends Component
{
    public $candidate;

    public function generatePdf()
    {
        $cres = $this->candidate->cres;
        $candidate = $this->candidate;
        $pdfName = 'CRE_' . $candidate->first_name . '_' . $candidate->last_name . '.pdf';
        $pdfDirectory = 'public/cres/';
        Storage::makeDirectory($pdfDirectory, 0777, true);
        $pdfPath = Storage::path($pdfDirectory . $pdfName);
        Pdf::view('livewire.back.cres.pdf', compact('cres', 'candidate'))->save($pdfPath);
        return response()->download($pdfPath);
    }

    public function render()
    {
        $cres = $this->candidate->cres;
        return view('livewire.back.cres.show')->with([
            'cres' => $cres,
        ]);
    }
}
