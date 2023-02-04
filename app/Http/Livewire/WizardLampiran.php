<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Product;
use Livewire\Component;
use App\Models\Lampiran;
use App\Models\Outlet;
use Illuminate\Support\Facades\Auth;

class WizardLampiran extends Component
{
    public $step = 1;
    public $name;
    public $address;
    public $product;
    public $outlet;
    public $quantity;
    public $percent;
    public $products = [];
    public $outlets = [];

    public $suggestions;

    public function mount()
    {
        $this->suggestions = [];
    }

    public function updatedName()
    {
        $this->search();
    }

    public function updatedAddress()
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
            if (strlen($this->name) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = User::where('id', 'like', "%{$this->name}%")
                ->orWhere('name', 'like', "%{$this->name}%")
                ->take(3)
                ->get();
        } elseif ($this->step === 2) {
            if (strlen($this->address) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Doctor::where('id', 'like', "%{$this->address}%")
                ->orWhere('name', 'like', "%{$this->address}%")
                ->take(3)
                ->get();
        } elseif ($this->step === 3) {
            if (strlen($this->product) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Product::where('product_nu', 'like', "%{$this->product}%")
                ->orWhere('name', 'like', "%{$this->product}%")
                ->take(3)
                ->get();
        } elseif ($this->step === 4) {
            if (strlen($this->outlet) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Outlet::where('outlet_nu', 'like', "%{$this->outlet}%")
                ->orWhere('name', 'like', "%{$this->outlet}%")
                ->take(3)
                ->get();
        }
    }

    public function setValues($value)
    {
        if ($this->step === 1) {
            $this->name = $value;
        } elseif ($this->step === 2) {
            $this->address = $value;
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
                'name' => ['required'],
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'address' => ['required'],
            ]);
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
            'product' => ['required'],
            'quantity' => ['required', 'numeric'],
            'percent' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $prod = Product::where('product_nu', '=', $product)->first();

        $this->products[] = [
            'product_nu' => $product,
            'product' => $prod->name,
            'quantity' => $quantity,
            'price' => $prod->price,
            'value' => $quantity * $prod->price,
            'percent' => $percent,
            'valueCicilan' => ($quantity * $prod->price) * ($percent / 100),
        ];

        $this->product = '';
        $this->quantity = '';
        $this->percent = '';
    }

    public function addOutlet($outlet)
    {
        $this->validate([
            'outlet' => ['required']
        ]);

        $out = Outlet::where('outlet_nu', '=', $outlet)->first();

        $this->outlets[] = [
            'outlet_nu' => $out->outlet_nu,
            'name' => $out->name,
            'address' => $out->address,
        ];

        $this->outlet = '';
    }

    public function remove($index, $type)
    {
        if ($type === 'PRODUCT') {
            array_splice($this->products, $index, 1);
        } elseif ($type === 'OUTLET') {
            array_splice($this->outlets, $index, 1);
        }
    }

    public function render()
    {
        return view('livewire.wizard-lampiran');
    }

    public function submit()
    {
        foreach ($this->outlets as $outlet) {
            foreach ($this->products as $product) {
                $lampiran = new Lampiran();
                $lampiran->user_id = $this->name;
                $lampiran->status = 1;
                $lampiran->periode = Carbon::now();
                $lampiran->doctor_id = $this->address;
                $lampiran->outlet_nu = $outlet['outlet_nu'];
                $lampiran->product_nu = $product['product_nu'];
                $lampiran->percent = $product['percent'];
                $lampiran->sales = $product['valueCicilan'];
                $lampiran->created_by = Auth::id();
                $saved = $lampiran->save();
                if (!$saved) {
                    //log error
                }
            }
        }
        return redirect('/');
    }
}
