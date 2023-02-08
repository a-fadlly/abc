<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index()
    {
        return view('lampiran.index');
    }

    public function showCreateForm()
    {
        return view('lampiran.create');
    }

    public function inProgress()
    {
        return view('lampiran.in-progress');
    }

    public function history()
    {
        return view('lampiran.history');
    }
}
