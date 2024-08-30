<?php

namespace App\Jobs;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ImportCandidatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $userId;

    public function __construct($filePath, $userId)
    {
        $this->filePath = $filePath;
        $this->userId = $userId;
    }

    public function handle()
    {
       

        $spreadsheet = IOFactory::load($this->filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $headers = $worksheet->toArray()[0];
        $worksheet->removeRow(1);
        $usagers = $worksheet->toArray();

        $batchSize = 1000;
        $chunks = array_chunk($usagers, $batchSize);

        foreach ($chunks as $chunk) {
            ProcessCandidateChunkJob::dispatch($chunk, $headers, $this->userId, $this->filePath);
        }
    }
}

