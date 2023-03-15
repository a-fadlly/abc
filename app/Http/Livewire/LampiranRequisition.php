<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LampiranRequisition extends Component
{
    public function render()
    {
        $lampirans = [];

        $role = Auth::user()->role;
        if ($role == 'MM') {
            $status = 1;
        } elseif ($role == 'DMD') {
            $status = 2;
        }

        $lampirans = Lampiran::join('users', 'users.username', '=', 'lampirans.created_by')
            ->where('status', $status) //1=diajukan, 2=diterima RSM, 3=ditolak RSM, 4=diterima MM, 5=ditolak MM
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query
                        ->where('users.ID_MM', '=', Auth::user()->username)
                        ->orWhere('users.ID_DMD', '=', Auth::user()->username);
                });
            })
            ->select('lampiran_nu', 'lampirans.username', 'doctor_nu', 'status')
            ->distinct()
            ->get();

        return view('livewire.lampiran-requisition', ['lampirans' => $lampirans]);
    }
}
