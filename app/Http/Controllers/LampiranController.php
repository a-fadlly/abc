<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function showCreateForm()
    {
        return view('lampiran.create');
    }
}
