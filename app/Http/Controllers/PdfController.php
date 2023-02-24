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
}
