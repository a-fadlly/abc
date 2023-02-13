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
    public $buttonVisible = false;
    public $toast = false;
    public $status = '';
    public $logs = [];
    public $lampirans;


    public function mount($lampiran_nu)
    {
        $this->lampirans = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->get();
        $role_id = Auth::user()->role_id;
        $lampiran = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->first();
        if ($role_id == 2 && $lampiran->status == 1) {
            $this->buttonVisible = supervisorExist($lampiran->user->reporting_manager);
            $this->status = 2;
        } elseif ($role_id == 3 && $lampiran->status == 2) {
            $this->buttonVisible = managerExist($lampiran->user->reporting_manager);
            $this->status = 4;
        }
    }

    public function updatedLogs()
    {
        //$this->logs = ActionLog::get();
    }

    public function approve($lampiran_nu)
    {
        Lampiran::where('lampiran_nu', '=', $lampiran_nu)->update(['status' => $this->status]);
        $this->buttonVisible = false;
        $this->toast = 'Approved!';
        $this->logs[] = [
            'action_type' => 'Approve',
            'target_type' => 'Lampiran',
            'user_id' => Auth::user()->id
        ];
    }

    public function reject($lampiran_nu)
    {
    }

    public function render()
    {
        return view('livewire.lampiran-view');
    }
}
