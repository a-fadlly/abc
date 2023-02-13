<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

function supervisorExist($id)
{
    //dd('managerExist');
    return User::where('id', '=', $id)->count() > 0;
}

function managerExist($id)
{
    //dd('managerManagerExist');
    $user = User::where('id', '=', $id)->first();
    return User::where('id', '=', $user->id)->count() > 0;
}

class LampiranView extends Component
{
    public $lampiran_nu;
    public $showButton = false;

    public function mount($lampiran_nu)
    {
        $this->lampiran_nu = $lampiran_nu;

        $role_id = Auth::user()->role_id;
        $lampiran = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->first();
        if ($role_id == 2 && $lampiran->status == config('constants.INITIATED')) {
            $this->showButton = supervisorExist($lampiran->user->reporting_manager);
        } elseif ($role_id == 3 && $lampiran->status == config('constants.MARKETING_MANAGER')) {
            $this->showButton = managerExist($lampiran->user->reporting_manager);
        }
    }

    public function render()
    {
        $lampirans = Lampiran::where('lampiran_nu', '=', $this->lampiran_nu)->get();
        return view('livewire.lampiran-view', ['lampirans' => $lampirans]);
    }
}
