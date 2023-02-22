<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranInProgress extends Component
{
    public $search = '';

    public function render()
    {
        $lampirans = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->where('created_by', '=', Auth::id())
            ->whereIn('status', [1, 2])
            ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode', 'created_by', 'status')
            ->distinct()
            ->get();

        return view('livewire.lampiran-in-progress', ['lampirans' => $lampirans]);
    }
}
