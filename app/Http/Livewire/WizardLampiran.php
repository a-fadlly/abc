<?php

namespace App\Http\Livewire;

use App\Models\ActionLog;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Outlet;
use App\Models\Product;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class WizardLampiran extends Component
{
    public $step = 1;
    public $user;
    public $name; //id
    public $doctor; //id
    public $product; //id
    public $outlet; //id
    public $quantity;
    public $percent;
    public $products = [];
    public $outlets = [];

    public $nameplaceholder;
    public $doctorplaceholder;

    public $suggestions;

    public function mount()
    {
        $this->suggestions = [];
    }

    public function updatedUser()
    {
        $this->search();
    }

    public function updatedName()
    {
        $this->search();
    }

    public function updatedNameplaceholder()
    {
        $this->search();
    }

    public function updatedDoctorplaceholder()
    {
        $this->search();
    }

    public function updatedDoctor()
    {
        $this->search();
    }

    public function updatedProduct()
    {
        $this->search();
    }

    public function updatedOutlet()
    {
        $this->search();
    }

    public function search()
    {
        if ($this->step === 1) {
            if (strlen($this->nameplaceholder) < 1) {
                $this->suggestions = [];
                return;
            }
            $ids = User::where('reporting_manager', '=', Auth::id())
                ->pluck('id')->toArray();
            foreach ($ids as $id) {
                array_push($ids, User::where('reporting_manager', '=', $id)->pluck('id')->toArray());
            }
            $this->suggestions = User::whereIn('id', flattenArray($ids))
                ->where('username', 'like', "%{$this->nameplaceholder}%")
                ->orWhere('name', 'like', "%{$this->nameplaceholder}%")
                ->where('role', '<', Auth::user()->role)
                ->take(10)
                ->get();
        } elseif ($this->step === 2) {
            if (strlen($this->doctorplaceholder) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Doctor::where('doctor_nu', 'like', "%{$this->doctorplaceholder}%")
                ->orWhere('name', 'like', "%{$this->doctorplaceholder}%")
                ->take(10)
                ->get();
        } elseif ($this->step === 3) {
            if (strlen($this->product) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Product::where('product_nu', 'like', "%{$this->product}%")
                ->orWhere('name', 'like', "%{$this->product}%")
                ->take(10)
                ->get();
        } elseif ($this->step === 4) {
            if (strlen($this->outlet) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Outlet::where('outlet_nu', 'like', "%{$this->outlet}%")
                ->orWhere('name', 'like', "%{$this->outlet}%")
                ->take(10)
                ->get();
        }
    }

    public function setValues($value)
    {
        if ($this->step === 1) {
            $this->name = $value;
            $user = User::where('id', '=', $value)->first();
            $this->nameplaceholder = $user->name;
            $this->user = $user;
        } elseif ($this->step === 2) {
            $this->doctor = $value;
            $doctor = Doctor::where('doctor_nu', '=', $value)->first();
            $this->doctorplaceholder = $doctor->name;
        } elseif ($this->step === 3) {
            $this->product = $value;
        } elseif ($this->step === 4) {
            $this->outlet = $value;
        }
        $this->suggestions = [];
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'name' => ['required', Rule::exists('users', 'id')->where('id', $this->name)],
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'doctor' => ['required', Rule::exists('doctors', 'doctor_nu')->where('doctor_nu', $this->doctor)],
            ]);
        } elseif ($this->step == 3) {
            $this->validate(
                [
                    'products' => ['required'],
                    'products.required' => 'Please select at least one of the products.'
                ],
            );
        } elseif ($this->step == 4) {
            $this->validate(
                [
                    'outlets' => ['required', 'array', 'min:1', 'max:5'],
                    'outlets.required' => 'Please select at least one of the outlets.'
                ],
            );
        }
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function addProduct($product, $quantity, $percent)
    {
        $this->validate([
            'product' => ['required', Rule::exists('products', 'product_nu')->where('product_nu', $product)],
            'quantity' => ['required', 'numeric'],
            'percent' => ['required', 'numeric', 'min:1', 'max:100'],
        ]);

        $prod = Product::where('product_nu', '=', $product)->first();
        $valueCicilan = ($quantity * $prod->price) * ($percent / 100);

        $this->products[] = [
            'product_nu' => $product,
            'product' => $prod->name,
            'quantity' => $quantity,
            'price' => $prod->price,
            'value' => $quantity * $prod->price,
            'percent' => $percent,
            'valueCicilan' => $valueCicilan,
        ];

        $this->product = '';
        $this->quantity = '';
        $this->percent = '';
    }

    public function addOutlet($outlet)
    {
        $this->validate([
            'outlet' => ['required', Rule::exists('outlets', 'outlet_nu')->where('outlet_nu', $outlet)],
        ]);

        $out = Outlet::where('outlet_nu', '=', $outlet)->first();

        $this->outlets[] = [
            'outlet_nu' => $out->outlet_nu,
            'name' => $out->name,
            'address' => $out->address,
        ];

        $this->outlet = '';
    }

    public function removeOutlet($index)
    {
        array_splice($this->outlets, $index, 1);
    }

    public function removeProduct($index)
    {
        array_splice($this->products, $index, 1);
    }

    public function render()
    {
        return view('livewire.wizard-lampiran');
    }

    public function submit()
    {
        $now = Carbon::now();
        $lampiran_nu = Lampiran::max('lampiran_nu') + 1;

        $products = [];
        $outlets = [];

        foreach ($this->outlets as $outlet) {

            $outlets[] = $outlet['outlet_nu'];

            foreach ($this->products as $product) {
                $lampiran = new Lampiran();
                $lampiran->lampiran_nu = $lampiran_nu;
                $lampiran->user_id = $this->name;
                $lampiran->status = 1;
                $lampiran->doctor_nu = $this->doctor;
                $lampiran->outlet_nu = $outlet['outlet_nu'];
                $lampiran->product_nu = $product['product_nu'];
                $lampiran->quantity = $product['quantity'];
                $lampiran->percent = $product['percent'];
                $lampiran->sales = $product['value'];
                $lampiran->created_by = Auth::id();
                $lampiran->save();

                $products[] = $product['product_nu'];
            }
        }

        $data = array('doctor' => $this->doctor, 'products' => $this->products, 'outlets' => $this->outlets);

        $action_log = new ActionLog();
        $action_log->action_type = "Initiated";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $lampiran_nu;
        $action_log->user_id = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = json_encode($data);
        $action_log->save();
        return redirect('/lampiran');
    }
}
