<?php

namespace App\Livewire\Back\Cres;

use Livewire\Component;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Storage;
use function Spatie\LaravelPdf\Support\pdf;
class Show extends Component
{
    public $candidate;
    public function generatePdf()
    {
        return pdf()
            ->view('livewire.back.cres.pdf', [
                'invoiceNumber' => '1234',
                'customerName' => 'Grumpy Cat',
            ])
            ->name('invoice-2023-04-10.pdf')
            ->download();
    }
    public function generatePdfd()
    {
        try {
            $cres = $this->candidate->cres;
            $candidate = $this->candidate;
            $pdfName = 'CRE_' . $candidate->first_name . '_' . $candidate->last_name . '.pdf';
            $pdfPath = public_path('nom_du_fichier.pdf');
            // $pdfDirectory = 'public/cres/';
            // Storage::makeDirectory($pdfDirectory, 0777, true);
            // $pdfPath = Storage::path($pdfDirectory . $pdfName);
            Pdf::view('livewire.back.cres.pdf', [
                'invoiceNumber' => '1234',
                'customerName' => 'Grumpy Cat',
            ])->save($pdfPath);
            
            return response()->download($pdfPath);
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Erreur lors de la génération du PDF : ' . $e->getMessage());
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
