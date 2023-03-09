<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $countApproval = 0;

        if ($role == 'RSM') {
            $usernames = User::where('reporting_manager', '=', Auth::user()->username)->pluck('username')->toArray();
            $countApproval = Lampiran::whereIn('created_by', $usernames)
                ->where('status', '=', 1)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'username', 'doctor_nu')
                ->distinct()
                ->get();
        } elseif ($role == 'MM') {
            $usernames = User::where('reporting_manager_manager', '=', Auth::user()->username)->pluck('username')->toArray();

            $countApproval = Lampiran::whereIn('created_by', $usernames)
                ->where('status', '=', 2)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'username', 'doctor_nu')
                ->distinct()
                ->get();
        }

        $countInProgress = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->where('created_by', '=', Auth::user()->username)
            ->whereIn('status', [1, 2])
            ->select('lampiran_nu', 'username', 'doctor_nu', 'created_by')
            ->distinct()
            ->get();
        return view(
            'lampiran.index',
            [
                'countInProgress' => $countInProgress ? $countInProgress->count() :  0,
                'countApproval' => $countApproval ? $countApproval->count() : 0
            ]
        );
    }

    public function showCreateForm()
    {
        return view('lampiran.create');
    }

    public function showUpdateForm()
    {
        return view('lampiran.update');
    }

    public function inProgress()
    {
        return view('lampiran.in-progress');
    }

    public function history()
    {
        return view('lampiran.history');
    }

    public function approve($lampiran_nu)
    {
        return view('lampiran.approve', ['lampiran_nu' => $lampiran_nu]);
    }

    public function requisition()
    {
        return view('lampiran.requisition');
    }


    public function inProgressView($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu, 'view_type' => 'in_progress']);
    }

    public function historyView($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu, 'view_type' => 'history']);
    }

    public function approvalView($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu, 'view_type' => 'approval']);
    }

    public function biodataView($biodata_id)
    {
        return view('biodata.view', ['biodata_id' => $biodata_id]);
    }
}
