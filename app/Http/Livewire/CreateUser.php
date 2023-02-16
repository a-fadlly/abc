<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

class CreateUser extends Component
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $roles;
    public $reporting_manager;
    public $managers;
    public $rayon;
    public $regional;


    public function render()
    {
        return view('livewire.create-user');
    }

    public function mount()
    {
        $this->roles = Role::whereIn('id', [2, 3, 4])->get();
        $this->managers = User::where('role_id', $this->role_id + 1)->get();
    }

    public function updatedRoleId()
    {
        $this->managers = User::where('role_id', $this->role_id + 1)->get();
        $this->reporting_manager = null;
    }

    public function saveUser()
    {
        $this->validate([
            'name' => ['required', 'min:3'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:1', 'max:8'],
            'role_id' => ['required'],
            'reporting_manager' => ['required'],
            'rayon' => [],
            'regional' => [],
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = bcrypt($this->passowrd);
        $user->role_id = $this->role_id;
        $user->reporting_manager = $this->reporting_manager;
        $additioanal_details['rayon'] = $this->rayon;
        $additioanal_details['regional'] = $this->regional;
        $user->additional_details = json_encode($additioanal_details);
        $user->save();

        return redirect('/users');
    }
}
