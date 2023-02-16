<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{
    public $user_id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $role_id;
    public $reporting_manager;
    public $rayon;
    public $regional;

    public $roles;
    public $managers;

    public function mount($user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        $this->reporting_manager = $user->reporting_manager;

        $additional_details = json_decode($user->additional_details, true);
        $this->rayon = $additional_details['rayon'];
        $this->regional = $additional_details['regional'];

        $this->roles = Role::all();
        $this->managers = User::where('role_id', $this->role_id + 1)->get();
    }


    public function updatedRoleId()
    {
        $this->managers = User::where('role_id', $this->role_id + 1)->get();
        $this->reporting_manager = null;
    }

    public function updateUser()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'username'  => 'required',
            'email' => 'required',
            'password' => 'nullable|string|min:1',
            'role_id' => 'required',
            'reporting_manager' => 'nullable',
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
        $user->role_id = $this->role_id;
        $user->reporting_manager = $this->reporting_manager;
        $additioanal_details['rayon'] = $this->rayon;
        $additioanal_details['regional'] = $this->regional;
        $user->additional_details = json_encode($additioanal_details);
        $user->save();

        return redirect('/users');
    }

    public function render()
    {
        return view('livewire.update-user');
    }
}
