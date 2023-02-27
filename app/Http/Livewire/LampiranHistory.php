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
        $lampirans = Lampiran::join('users', 'users.id', '=', 'lampirans.user_id')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            ->whereIn('lampirans.status', [3, 4, 5])
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.doctor_nu', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->search . '%');
            })
            ->select('lampiran_nu', 'user_id', 'doctors.doctor_nu', 'created_by', 'status')
            ->distinct()
            ->get();

        return view('livewire.lampiran-history', ['lampirans' => $lampirans]);
    }
}
