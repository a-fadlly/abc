<?php

namespace App\Http\Livewire;

use App\Models\Lampiran;
use Livewire\Component;

class LampiranView extends Component
{
    public $lampiran_nu;

    public function mount($lampiran_nu)
    {
        $this->lampiran_nu = $lampiran_nu;
    }

    public function render()
    {
        $lampirans = Lampiran::where('lampiran_nu', '=', $this->lampiran_nu)->get();
        return view('livewire.lampiran-view', ['lampirans' => $lampirans]);
    }
}
