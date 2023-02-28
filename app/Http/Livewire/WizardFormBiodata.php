<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;

class WizardFormBiodata extends Component
{
    public $step = 1;

    public $name;
    public $specialty;
    public $status;
    public $gender;
    public $birthplace;
    public $birthdate;
    public $religion;
    public $marital_status;
    public $hobby;
    public $address;
    public $phone;
    public $mobile_phone;

    public $spouse;
    public $childs; //array
    public $educations; //array

    public $workplace;
    public $work_address;
    public $work_phone;
    public $fax;

    public $patients_per_day;

    public $products; //array
    public $competitor_products; //array
    public $outlets; //array

    public $notes;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.wizard-form-biodata');
    }

    public function nextStep()
    {
        // if ($this->step == 1) {
        //     $this->validate([
        //         //validate
        //     ]);
        // } elseif ($this->step == 2) {
        //     $this->validate([
        //         //validate
        //     ]);
        // } elseif ($this->step == 3) {
        //     $this->validate([
        //         //validate
        //     ]);
        // } elseif ($this->step == 4) {
        //     $this->validate([
        //         //validate
        //     ]);
        // }
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function submit()
    {
        dd($this);
    }
}