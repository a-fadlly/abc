<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('pdf', $data);

        return $pdf->stream( 'hdtuto.pdf', array("Attachment" => false));
    }
}
