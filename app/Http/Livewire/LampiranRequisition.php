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
        $role_id = Auth::user()->role_id;
        $lampirans = [];
        if ($role_id == 3) {
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            $lampirans = Lampiran::whereIn('created_by', $ids)
                ->where('status', '=', 1)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'created_by')
                ->distinct()
                ->get();
        } elseif ($role_id == 4) {
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            foreach ($ids as $id) {
                array_push($ids, User::where('reporting_manager', '=', $id)->pluck('id')->toArray());
            }

            $lampirans = Lampiran::whereIn('created_by', flattenArray($ids))
                ->where('status', '=', 2)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'created_by')
                ->distinct()
                ->get();
        }

        return view('livewire.lampiran-requisition', ['lampirans' => $lampirans]);
    }
}
