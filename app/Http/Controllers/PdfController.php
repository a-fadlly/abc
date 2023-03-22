<?php
namespace App\Http\Controllers;

use PDF;
use App\Models\Lampiran;

class PdfController extends Controller
{
    public function generatePdf($lampiran_nu, $status = [1, 2, 4], $fileNamePrefix = 'lampiran')
    {
        $lampirans = Lampiran::where('lampiran_nu', $lampiran_nu)
            ->whereIn('status', $status)
            ->get();
        $pdf = PDF::loadView('pdf', compact('lampirans'));
        return $pdf->stream("{$fileNamePrefix}.pdf", ['Attachment' => false]);
    }

    public function generateLampiranPdf($lampiran_nu)
    {
        return $this->generatePdf($lampiran_nu);
    }

    public function inProgressPrint($lampiran_nu)
    {
        return $this->generatePdf($lampiran_nu, [1, 2], 'lampiran-in-progress');
    }

    public function historyPrint($lampiran_nu)
    {
        return $this->generatePdf($lampiran_nu, [4], 'lampiran-history');
    }
}
