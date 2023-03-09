<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\ActionLog;
use Illuminate\Support\Facades\Auth;

class UpdateUser extends Component
{
    public $user_id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $role;
    public $reporting_manager;
    public $reporting_manager_manager;
    public $rayon;
    public $regional;

    public $roles;

    public function mount($user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->reporting_manager = $user->reporting_manager;
        $this->reporting_manager_manager = $user->reporting_manager_manager;

        $additional_details = json_decode($user->additional_details, true);
        $this->rayon = $additional_details['rayon'] ?? null;
        $this->regional = $additional_details['regional'] ?? null;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'username'  => 'required',
            'email' => 'required',
            'password' => 'nullable|string|min:1',
            'role' => 'required',
            'reporting_manager' => 'nullable',
            'reporting_manager_manager' => 'nullable',
            'rayon' => 'nullable',
            'regional' => 'nullable'
        ]);

        $user = User::where('id', '=', $this->user_id)->first();
        $user->name = $this->name;
        $user->username  = $this->username;
        $user->email = $this->email;
        if ($this->password) {
            $user->password  = bcrypt($this->password);
        }
        $user->role = $this->role;
        $user->reporting_manager = $this->reporting_manager;
        $user->reporting_manager_manager = $this->reporting_manager_manager;
        $additioanal_details['rayon'] = $this->rayon;
        $additioanal_details['regional'] = $this->regional;
        $user->additional_details = json_encode($additioanal_details);
        $user->save();

        $action_log = new ActionLog();
        $action_log->action_type = "Update";
        $action_log->target_type = "User";
        $action_log->target_id = $user->id;
        $action_log->username = Auth::user()->username;
        $action_log->name = Auth::user()->name;
        $action_log->note = json_encode($user);
        $action_log->save();

        return redirect('/users');
    }

    public function render()
    {
        return view('livewire.update-user');
    }
}
