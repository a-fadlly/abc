<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Lampiran;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf($lampiran_nu)
    {
        $lampirans = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->get();
        $pdf = PDF::loadView('pdf', ['lampirans' => $lampirans]);
        return $pdf->stream('hdtuto.pdf', array("Attachment" => false));
    }
}
