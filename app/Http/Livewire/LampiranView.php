<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

function managerExist($manager_username)
{
    return User::where('reporting_manager', '=', $manager_username)->count() > 0;
}

function managerManagerExist($manager_manager_username)
{
    return User::where('reporting_manager_manager', '=', $manager_manager_username)->count() > 0;
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
        $this->lampiran_nu = $lampiran_nu;
        $this->view_type = $view_type;

        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($this->view_type == 'in_progress') {
            $this->lampirans = Lampiran::where(['lampiran_nu' => $this->lampiran_nu])
                ->whereIn('status', [1, 2, 4])
                ->get();
        } elseif ($this->view_type == 'history') {

            $this->lampirans = Lampiran::where(['lampiran_nu' => $this->lampiran_nu])
                ->where('status', '=', '4')
                ->where('is_expired', '=', '0')
                ->get();

            // dd($this->lampirans[0]);

        } elseif ($this->view_type == 'approval') {
            $this->lampirans = Lampiran::where(['lampiran_nu' => $this->lampiran_nu])
                ->whereIn('status', Auth::user()->role == 'RSM' ? [1, 4] : [2, 4])
                ->get();
        }
        $role = Auth::user()->role;
        if ($role == 'RSM') {
            $this->button_visible = managerExist($this->lampirans[0]->createdBy->reporting_manager);
        } elseif ($role == 'MM') {
            $this->button_visible = managerManagerExist($this->lampirans[0]->createdBy->reporting_manager_manager);
        }
    }

    public function updatedLogs()
    {
        $this->findLogs();
    }

    public function findLogs()
    {
        $this->logs = ActionLog::where('target_id', '=', $this->lampiran_nu)
            ->where('target_type', '=', 'lampiran')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function approve()
    {
        Lampiran::where(['lampiran_nu' => $this->lampiran_nu])
            ->whereIn('id', $this->lampirans->pluck('id')->toArray())
            ->update([
                'status' => Auth::user()->role == 'RSM' ? '2' : '4',
            ]);
        $this->button_visible = false;
        $this->toast = 'Approved';
        $action_log = new ActionLog();
        $action_log->action_type = "Approved";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $this->lampiran_nu;
        $action_log->username = Auth::user()->username;
        $action_log->name = Auth::user()->name;
        $action_log->note = '';
        $action_log->save();

        $this->findLogs();
    }

    public function reject()
    {
        Lampiran::where('lampiran_nu', '=', $this->lampiran_nu)->update(['status' => Auth::user()->role == 'RSM' ? '3' : '5']);
        $this->button_visible = false;
        $this->toast = 'Rejected';
        $action_log = new ActionLog();
        $action_log->action_type = "Rejected";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $this->lampiran_nu;
        $action_log->username = Auth::user()->username;
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
