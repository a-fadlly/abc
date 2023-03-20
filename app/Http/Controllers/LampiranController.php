<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LampiranController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $countApproval = 0;

        if ($role == 'MM') {
            $countLampiran = Lampiran::join('users', 'users.username', '=', 'lampirans.created_by')
                ->where('status', '=', 1) //1=diajukan, 2=diterima RSM, 3=ditolak RSM, 4=diterima MM, 5=ditolak MM
                ->where('users.ID_MM', '=', Auth::user()->username)
                ->select('lampiran_nu', 'lampirans.username', 'doctor_nu')
                ->distinct();

            $countBiodata = Biodata::join('users', 'users.username', '=', 'biodatas.created_by')
                ->where('status', '=', 1) //1=diajukan, 2=diterima RSM, 3=ditolak RSM, 4=diterima MM, 5=ditolak MM
                ->where('users.ID_MM', '=', Auth::user()->username)
                ->select(DB::raw('biodatas.id as lampiran_nu'), 'biodatas.username', DB::raw('biodatas.name as doctor_nu'))
                ->distinct();

            $countApproval = $countLampiran->union($countBiodata)->get();
        } elseif ($role == 'DMD') {
            $countLampiran = Lampiran::join('users', 'users.username', '=', 'lampirans.created_by')
                ->where('status', '=', 2)
                ->select('lampiran_nu', 'lampirans.username', 'doctor_nu')
                ->distinct();

            $countBiodata = Biodata::join('users', 'users.username', '=', 'biodatas.created_by')
                ->where('status', '=', 2) //1=diajukan, 2=diterima RSM, 3=ditolak RSM, 4=diterima MM, 5=ditolak MM
                ->select(DB::raw('biodatas.id as lampiran_nu'), 'biodatas.username', DB::raw('biodatas.name as doctor_nu'))
                ->distinct();

            $countApproval = $countLampiran->union($countBiodata)->get();
        }

        $countInProgress = Lampiran::join('users', 'users.username', '=', 'lampirans.created_by')
            ->whereIn('status', [1, 2]) //1=diajukan, 2=diterima RSM, 3=ditolak RSM, 4=diterima MM, 5=ditolak MM
            ->where('users.reporting_manager_manager', '=', Auth::user()->username)
            ->select('lampiran_nu', 'lampirans.username', 'doctor_nu')
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
