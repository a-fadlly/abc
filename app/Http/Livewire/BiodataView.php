<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Outlet;
use App\Models\Biodata;
use App\Models\Lampiran;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class BiodataView extends Component
{
    public $button_visible = false;
    public $toast = false;

    public $biodata;

    public function mount($biodata_id)
    {
        $this->biodata = Biodata::where(['id' => $biodata_id])->first();

        $role = Auth::user()->role;
        if ($role == 'MM' && $this->biodata->status == 1) {
            $this->button_visible = managerExist($this->biodata->createdBy->ID_MM);
        } elseif ($role == 'DMD' && $this->biodata->status == 2) {
            $this->button_visible = deputyExist($this->biodata->createdBy->ID_DMD);
        } elseif ($role == 'FIN' && $this->biodata->status == 4) {
            $this->button_visible = true;
        }
    }

    public function approve()
    {
        $this->button_visible = false;

        $role = Auth::user()->role;
        switch ($role) {
            case 'MM':
                $status = '2';
                break;
            case 'DMD':
                $status = '4';
                break;
            case 'FIN':
                $status = '6';
                break;
            default:
                break;
        }
        $this->biodata->status = $status;
        if ($role == 'DMD') {
            $doctor = new Doctor();
            $doctor->doctor_nu = Doctor::orderBy('id', 'desc')->value('doctor_nu') + 1;
            $doctor->name = $this->biodata->name;
            $doctor->address = $this->biodata->address;
            $doctor->KODE_MDRP1 = $this->biodata->username;
            $doctor->save();
            // dd($doctor->doctor_nu);
            $decoded = json_decode($this->biodata->additional_details);

            foreach ($decoded->outlets as $out) {

                foreach ($decoded->products as $prod) {
                    $lampiran = new Lampiran();
                    $lampiran->lampiran_nu = $this->biodata->username . "" . $doctor->doctor_nu;
                    $lampiran->username = $this->biodata->username;
                    $lampiran->status = 4;
                    $lampiran->doctor_nu = $doctor->doctor_nu;
                    $lampiran->outlet_nu = $out->outlet_nu;
                    $lampiran->product_nu = $prod->product_nu;
                    $lampiran->price_at_that_time = $prod->product_price;
                    $lampiran->quantity = $prod->product_quantity;
                    $lampiran->percent = $prod->product_percent;
                    $lampiran->sales = 0;
                    $lampiran->is_expired = 0;
                    $lampiran->created_by = Auth::user()->username;
                    $lampiran->save();
                }
            }
        }
        $this->biodata->save();
    }

    public function reject()
    {
        $this->button_visible = false;

        $role = Auth::user()->role;
        switch ($role) {
            case 'MM':
                $status = '3';
                break;
            case 'DMD':
                $status = '5';
                break;
            case 'FIN':
                $status = '7';
                break;
            default:
                break;
        }
        $this->biodata->status = $status;
        $this->biodata->save();
    }

    public function render()
    {
        return view('livewire.biodata-view');
    }
}
