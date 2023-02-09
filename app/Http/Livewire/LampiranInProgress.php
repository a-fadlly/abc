<?php

namespace App\Http\Livewire;

use App\Models\Lampiran;
use Livewire\Component;

class LampiranInProgress extends Component
{
    public $search = '';

    public function render()
    {
        $lampirans = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->select('lampiran_nu', 'user_id', 'doctor_nu')
            ->distinct()
            ->get();

        return view('livewire.lampiran-in-progress', ['lampirans' => $lampirans]);
    }
}
