<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 
class LampiranRequisition extends Component
{
    public function render()
    {
        $lampirans = [];

        $status = 1;
        if (Auth::user()->role == 'MM') {
            $status = 2;
        }

        if (!is_null(Session::get('usernames')) && count(Session::get('usernames')) > 0) {
            $lampirans = Lampiran::whereIn('username', Session::get('usernames'))
                ->where('status', '=', $status)
                ->with('user:id,name,username', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'lampirans.username', 'doctor_nu', 'created_by', 'status')
                ->distinct()
                ->get();
        }

        return view('livewire.lampiran-requisition', ['lampirans' => $lampirans]);
    }
}
