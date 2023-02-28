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
    public $view_type;

    public $button_visible = false;
    public $toast = false;
    public $logs;
    public $lampirans;

    public function mount($lampiran_nu, $view_type)
    {
        $this->view_type = $view_type;

        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($this->view_type == 'in_progress') {
            $this->lampirans = Lampiran::where(['lampiran_nu' => $lampiran_nu])
                ->whereIn('status', [1, 2])
                ->get();
        } elseif ($this->view_type == 'history') {
            $this->lampirans = Lampiran::where(['lampiran_nu' => $lampiran_nu])
                ->whereIn('status', [4])
                ->where('is_expired', '=', '0')
                ->get();
        } elseif ($this->view_type == 'approval') {
            $this->lampirans = Lampiran::where(['lampiran_nu' => $lampiran_nu])
                ->where('status', Auth::user()->role_id == 3 ? 1 : 2)
                ->get();
        }

        $role_id = Auth::user()->role_id;
        //$lampiran = Lampiran::where('lampiran_nu', '=', $lampiran_nu)->first();
        if ($role_id == 3 && $this->lampirans[0]->status == 1) {
            $this->button_visible = supervisorExist($this->lampirans[0]->user->reporting_manager);
        } elseif ($role_id == 4 && $this->lampirans[0]->status == 2) {
            $this->button_visible = managerExist($this->lampirans[0]->user->reporting_manager);
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
        Lampiran::where(['lampiran_nu' => $lampiran_nu])
            ->whereIn('id', $this->lampirans->pluck('id')->toArray())
            ->update([
                'status' => Auth::user()->role_id == 3 ? '2' : '4',
            ]);
        $this->button_visible = false;
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
        $this->button_visible = false;
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
