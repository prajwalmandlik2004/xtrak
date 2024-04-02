<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\LaravelPdf\Facades\Pdf;

class DownloadInvoiceController
{
    public function __invoke()
    {
        return Pdf::view('livewire.back.cres.pdf', [
            'invoiceNumber' => '1234',
            'customerName' => 'Grumpy Cat',
        ])
            ->format('a4')
            ->name('invoice-2023-04-10.pdf')
            ->download();
    }
}
