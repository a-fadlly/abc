<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\ActionLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CreateUser extends Component
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $role;
    public $roles;
    public $reporting_manager;
    public $reporting_manager_manager;
    public $rayon;
    public $regional;


    public function render()
    {
        return view('livewire.create-user');
    }

    public function mount()
    {
    }

    public function saveUser()
    {
        $this->validate([
            'name' => ['required', 'min:3'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:1', 'max:8'],
            'role' => ['required'],
            'reporting_manager' => ['nullable'],
            'reporting_manager_manager' => ['nullable'],
            'rayon' => [],
            'regional' => [],
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->role = $this->role;
        $user->reporting_manager = $this->reporting_manager;
        $user->reporting_manager_manager = $this->reporting_manager_manager;
        $additioanal_details['rayon'] = $this->rayon;
        $additioanal_details['regional'] = $this->regional;
        $user->additional_details = json_encode($additioanal_details);
        $user->save();

        $action_log = new ActionLog();
        $action_log->action_type = "Create";
        $action_log->target_type = "User";
        $action_log->target_id = $user->id;
        $action_log->username = Auth::user()->username;
        $action_log->name = Auth::user()->name;
        $action_log->note = json_encode($user);
        $action_log->save();

        return redirect('/users');
    }
}
