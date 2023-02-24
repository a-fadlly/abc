<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

function supervisorExist($id)
{
    return User::where('id', '=', $id)
        ->count() > 0;
}

function managerExist($id)
{
    $user = User::where('id', '=', $id)->first();
    return User::where('id', '=', $user->id)->count() > 0;
}

class LampiranView extends Component
{
    public $lampiran_nu;
    public $buttonVisible = false;
    public $toast = false;
    public $logs;
    public $lampirans;

    public function mount($lampiran_nu)
    {
        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)
            ->orderBy('created_at', 'DESC')
            ->get();
        $this->lampirans = Lampiran::where([
            'lampiran_nu' => $lampiran_nu
        ])->get();
        $role_id = Auth::user()->role_id;
        //$lampiran = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->first();
        if ($role_id == 3 && $this->lampirans[0]->status == 1) {
            $this->buttonVisible = supervisorExist($this->lampirans[0]->user->reporting_manager);
        } elseif ($role_id == 4 && $this->lampirans[0]->status == 2) {
            $this->buttonVisible = managerExist($this->lampirans[0]->user->reporting_manager);
        }
    }

    public function updatedLogs()
    {
        $this->findLogs();
    }

    public function findLogs()
    {
        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)->where('target_type', '=', 'lampiran')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function approve($lampiran_nu)
    {
        Lampiran::where('lampiran_nu', '=', $lampiran_nu)->update(['status' => Auth::user()->role_id == 3 ? '2' : '4']);
        $this->buttonVisible = false;
        $this->toast = 'Approved';
        $action_log = new ActionLog();
        $action_log->action_type = "Approved";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $lampiran_nu;
        $action_log->user_id = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = '';
        $action_log->save();

        $this->findLogs();
    }

    public function reject($lampiran_nu)
    {
        Lampiran::where('lampiran_nu', '=', $lampiran_nu)->update(['status' => Auth::user()->role_id == 3 ? '3' : '5']);
        $this->buttonVisible = false;
        $this->toast = 'Rejected';
        $action_log = new ActionLog();
        $action_log->action_type = "Rejected";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $lampiran_nu;
        $action_log->user_id = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = '';
        $action_log->save();

        $this->findLogs();
    }

    public function render()
    {
        return view('livewire.lampiran-view');
    }
}
