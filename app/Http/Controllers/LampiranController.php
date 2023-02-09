<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use Illuminate\Http\Request;

class LampiranController extends Controller
{
    public function index()
    {
        $countLampiranInProgress = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->select('lampiran_nu', 'user_id', 'doctor_nu')
            ->distinct()->count();
        return view('lampiran.index', ['countLampiranInProgress' => $countLampiranInProgress]);
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

    public function view($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu]);
    }

    public function approval()
    {
        return view('lampiran.approval');
    }
}
