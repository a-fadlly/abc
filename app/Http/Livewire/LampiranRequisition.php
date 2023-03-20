<?php

namespace App\Http\Livewire;

use App\Models\Biodata;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LampiranRequisition extends Component
{
    public function render()
    {
        $lampirans = [];

        $role = Auth::user()->role;
        if ($role == 'FIN') {
            $lampiransAndBiodatas = Biodata::join('users', 'users.username', '=', 'biodatas.created_by')
                ->where('status', 4)
                ->select(
                    DB::raw('biodatas.id as lampiran_nu'),
                    'biodatas.username',
                    DB::raw('biodatas.name as doctor_nu'),
                    'status',
                    DB::raw('"Ajuan Baru" as tipe')
                )
                ->distinct()
                ->get();
        } else {
            if ($role == 'MM') {
                $status = 1;
            } elseif ($role == 'DMD') {
                $status = 2;
            } else {
                $status = 0;
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
                ->select(
                    'lampiran_nu',
                    'lampirans.username',
                    'doctor_nu',
                    'status',
                    DB::raw('"Lampiran" as tipe')
                )
                ->distinct();

            $biodatas = Biodata::join('users', 'users.username', '=', 'biodatas.created_by')
                ->where('status', $status)
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('users.ID_MM', '=', Auth::user()->username)
                            ->orWhere('users.ID_DMD', '=', Auth::user()->username);
                    });
                })
                ->select(
                    DB::raw('biodatas.id as lampiran_nu'),
                    'biodatas.username',
                    DB::raw('biodatas.name as doctor_nu'),
                    'status',
                    DB::raw('"Ajuan Baru" as tipe')
                )
                ->distinct();

            $lampiransAndBiodatas = $lampirans->union($biodatas)->get();
        }

        return view('livewire.lampiran-requisition', ['lampirans' => $lampiransAndBiodatas]);
    }
}
