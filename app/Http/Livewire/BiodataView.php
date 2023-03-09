<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Biodata;
use Livewire\Component;
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

class BiodataView extends Component
{
    public $button_visible = false;
    public $toast = false;

    public $biodata;

    public function mount($biodata_id)
    {
        $this->biodata = Biodata::where(['id' => $biodata_id])->first();

        $role = Auth::user()->role;
        if ($role == 'RSM' && $this->biodata->status == 1) {
            $this->button_visible = supervisorExist($this->biodata->user->reporting_manager);
        } elseif ($role == 'MM' && $this->biodata->status == 2) {
            $this->button_visible = managerExist($this->biodata->user->reporting_manager);
        }
    }

    public function approve()
    {
        $doctor = new Doctor();
        $doctor->doctor_nu = '';
        $doctor->name = $this->biodata->name;
        $doctor->address = $this->biodata->address;
        $doctor->save();
    }

    public function reject()
    {
    }

    public function render()
    {
        return view('livewire.biodata-view');
    }
}
