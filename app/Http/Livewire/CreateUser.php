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
    public $role;
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
        $this->managers = User::where('role_id', $this->role + 1)->get();
    }

    public function updatedRole()
    {
        $this->managers = User::where('role_id', $this->role + 1)->get();
        $this->reporting_manager = null;
    }

    public function saveUser()
    {
        $validatedData  = $this->validate([
            'name' => ['required', 'min:3'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:1', 'max:8'],
            'role' => ['required'],
            'reporting_manager' => ['required'],
            'rayon' => [],
            'regional' => [],
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role_id = $validatedData['role'];
        $user->reporting_manager = $validatedData['reporting_manager'];
        $additioanal_details['rayon'] = $validatedData['rayon'];
        $additioanal_details['regional'] = $validatedData['regional'];
        $user->additional_details = json_encode($additioanal_details);
        $user->save();

        return redirect('/users');
    }
}
