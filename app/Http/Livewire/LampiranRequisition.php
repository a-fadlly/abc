<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranRequisition extends Component
{
    public function render()
    {
        $role = Auth::user()->role;
        $lampirans = [];
        $status = 1;

        if ($role == 'RSM') {
            $ids = User::where('reporting_manager', '=', Auth::user()->username)->pluck('username')->toArray();
        } elseif ($role == 'MM') {
            $ids = User::where('reporting_manager_manager', '=', Auth::user()->username)->pluck('username')->toArray();
            $status = 2;
        }

        if (isset($ids) && count($ids) > 0) {

            $lampirans = Lampiran::whereIn('created_by', $ids)
                ->where('status', '=', $status)
                ->with('user:id,name,username', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'lampirans.username', 'doctor_nu', 'created_by', 'status')
                ->distinct()
                ->get();
        }

        return view('livewire.lampiran-requisition', ['lampirans' => $lampirans]);
    }
}
