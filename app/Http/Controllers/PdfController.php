<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Lampiran;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generateLampiranPdf($lampiran_nu)
    {
        $lampirans = Lampiran::where(['lampiran_nu' => $lampiran_nu])->get();
        $pdf = PDF::loadView('pdf', ['lampirans' => $lampirans]);
        return $pdf->stream('lampiran.pdf', array("Attachment" => false));
    }

    public function inProgressPrint($lampiran_nu)
    {
        $lampirans = Lampiran::where(['lampiran_nu' => $lampiran_nu])
            ->whereIn('status', [1, 2])
            ->get();
        $pdf = PDF::loadView('pdf', ['lampirans' => $lampirans]);
        return $pdf->stream('lampiran-in-progress.pdf', array("Attachment" => false));
    }

    public function historyPrint($lampiran_nu)
    {
        $lampirans = Lampiran::where([
            'lampiran_nu' => $lampiran_nu,
            'status' => 4,
            'is_expired' => 0
        ])
            ->get();
        $pdf = PDF::loadView('pdf', ['lampirans' => $lampirans]);
        return $pdf->stream('lampiran-history.pdf', array("Attachment" => false));
    }
}
