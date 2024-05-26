<?php

namespace App\Livewire\Back\Cres;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{
    public $candidate;
    public function generatePdf()
    {
        $html = view('livewire.back.cres.pdf', [
            'cres' => $this->candidate->cres,
            'candidate' => $this->candidate,
        ])->render();
        $response = Http::post('https://api.tailwindstream.io/public', [
            'html' => $html,
            'format' => 'a4',
        ]);
        if ($response->successful()) {
            $pdfFileName = uniqid('pdf_') . '.pdf';
            File::put(public_path($pdfFileName), $response->body());
            $pdfName = 'CRE ' . $this->candidate->first_name . '_' . $this->candidate->last_name . '.pdf';
            return response()->download(public_path($pdfFileName), $pdfName)->deleteFileAfterSend(true);
        } else {
            return response()->json(['error' => 'Une erreur est survenue la génération du PDF'], 500);
        }
    }
    public function render()
    {
        $cres = $this->candidate->cres;
        return view('livewire.back.cres.show')->with([
            'cres' => $cres,
        ]);
    }
}
