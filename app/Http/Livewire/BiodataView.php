<?php

namespace App\Http\Livewire;

use App\Models\Biodata;
use App\Models\Doctor;
use Livewire\Component;

class BiodataView extends Component
{
    public $biodata;

    public function mount($biodata_id)
    {
        $this->biodata = Biodata::where(['id' => $biodata_id])->first();
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
