<?php

namespace App\Livewire\Back\Candidates;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Import extends Component
{
    use WithFileUploads;
    public $file;
    public $fileData;

    public function storeData()
    {
        $validateData = $this->validate(
            [
                'file' => 'required',
            ],
            [
                'file.required' => 'Le fichier est obligatoire',
            ],
        );
        $path = Storage::putFile('/public/files', $validateData['file']);
        $filepath = Storage::path($path);

        if (file_exists($filepath)) {
            // try {
            $spreadsheet = IOFactory::load($filepath);
            $worksheet = $spreadsheet->getActiveSheet();
            $headers = $worksheet->toArray()[0];
            $worksheet->removeRow(1);
            $usagers = $worksheet->toArray();
            $fileData = collect($usagers)
                ->map(function ($usager) use ($headers) {
                    return array_combine($headers, $usager);
                })
                ->toArray();
            // dd($fileData);
            DB::beginTransaction();
        }
    }
    public function render()
    {
        return view('livewire.back.candidates.import');
    }
}
