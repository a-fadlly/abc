<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
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
    public $logs;
    public $lampirans;


    public function mount($lampiran_nu)
    {
        $this->logs =
        ActionLog::where('target_id', '=', $this->lampiran_nu)->orderBy('created_at', 'DESC')->get();
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
        $this->findLogs();
    }

    public function findLogs()
    {
        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)->orderBy('created_at', 'DESC')->get();
    }

    public function approve($lampiran_nu)
    {
        Lampiran::where('lampiran_nu', '=', $lampiran_nu)->update(['status' => $this->status]);
        $this->buttonVisible = false;
        $this->toast = 'Approved!';

        $action_log = new ActionLog();
        $action_log->action_type = "APPROVED";
        $action_log->target_type = "LAMPIRAN";
        $action_log->target_id = $lampiran_nu;
        $action_log->user_id = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = '';
        $action_log->save();

        $this->findLogs();
    }

    public function reject($lampiran_nu)
    {
    }

    public function render()
    {
        return view('livewire.lampiran-view');
    }
}
