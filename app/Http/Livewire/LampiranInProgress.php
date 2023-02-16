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
            ->whereNotIn('status', [3, 5, 6]) //3=direject rsm, 5=direject mm, 6=selesai
            ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode', 'created_by', 'status')
            ->distinct()
            ->get();

        return view('livewire.lampiran-in-progress', ['lampirans' => $lampirans]);
    }
}
