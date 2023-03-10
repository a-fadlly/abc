<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranHistory extends Component
{
    public $search = '';

    public function render()
    {
        $lampirans = Lampiran::join('users', 'users.username', '=', 'lampirans.username')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            ->whereIn('lampirans.status', [3, 4, 5])
            ->where('lampirans.is_expired', '0')
            ->where('lampirans.created_by', Auth::user()->username)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.doctor_nu', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->search . '%');
            })
            ->select('lampiran_nu', 'lampirans.username', 'doctors.doctor_nu', 'created_by', 'status')
            ->distinct()
            ->get();

        return view('livewire.lampiran-history', ['lampirans' => $lampirans]);
    }
}
