<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranHistory extends Component
{
    public function render()
    {
        $lampirans = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->where('created_by', '=', Auth::id())
            ->whereIn('status', [3, 5, 6])
            ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode', 'created_by', 'status')
            ->distinct()
            ->get();
        return view('livewire.lampiran-history', ['lampirans' => $lampirans]);
    }
}
