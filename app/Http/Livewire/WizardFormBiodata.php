<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Biodata;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class WizardFormBiodata extends Component
{
    public $step = 1;

    public $user_username;
    public $user_name;
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

    public $child_name, $child_age, $child_education;
    public $childs = [];

    public $edu, $grad_year;
    public $educations = [];

    public $workplace;
    public $work_address;
    public $work_phone;
    public $fax;

    public $patients_per_day;

    public $product_nu, $product_name, $product_price, $product_quantity, $product_percent;
    public $products = [];

    public $competitor_product_name;
    public $competitor_products = [];

    public $outlet_nu, $outlet_name, $outlet_address;
    public $outlets = [];

    public $notes;

    public $suggestions = [];

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.wizard-form-biodata');
    }

    public function search()
    {
        if ($this->step === 1) {
            if (strlen($this->user_name) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = User::distinct()
                ->select('users.id', 'users.name', 'users.username')
                ->where('reporting_manager_manager', Auth::user()->username)
                ->where('users.username', '!=', Auth::user()->username)
                ->take(10)
                ->get();
        } elseif ($this->step === 5) {
            if (strlen($this->product_name) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Product::where('product_nu', 'like', "%{$this->product_name}%")
                ->orWhere('name', 'like', "%{$this->product_name}%")
                ->take(10)
                ->get();
        } elseif ($this->step === 6) {
            if (strlen($this->outlet_name) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Outlet::where('outlet_nu', 'like', "%{$this->outlet_name}%")
                ->orWhere('name', 'like', "%{$this->outlet_name}%")
                ->take(10)
                ->get();
        }
    }

    public function setValues($value)
    {
        if ($this->step === 1) {
            $user = User::where('username', '=', $value)->first();
            $this->user_username = $user->username;
            $this->user_name = $user->name;
        } else if ($this->step === 5) {
            $this->product_nu = $value;
            $prod = Product::where('product_nu', '=', $value)->first();
            $this->product_nu = $prod->product_nu;
            $this->product_name = $prod->name;
            $this->product_price = $prod->price;
        } else if ($this->step === 6) {
            $this->outlet_nu = $value;
            $out = Outlet::where('outlet_nu_uni', '=', $value)->first();
            $this->outlet_name = $out->name_uni;
            $this->outlet_address = $out->address_uni;
        }

        $this->suggestions = [];
    }

    public function updatedUserName()
    {
        $this->search();
    }

    public function updatedProductName()
    {
        $this->search();
    }

    public function updatedOutletName()
    {
        $this->search();
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            //
        } else if ($this->step == 2) {
            $this->validate([
                'name' => 'required',
                'specialty' => 'required',
                'address' => 'required',
            ]);
        } else if ($this->step == 3) {
        } else if ($this->step == 4) {
        } else if ($this->step == 5) {
            $this->validate([
                'products' => ['required', 'array', 'min:1', 'max:5'],
                'products.required' => 'Please select at least one of the products.'
            ]);
        } else if ($this->step == 6) {
            $this->validate([
                'outlets' => ['required', 'array', 'min:1', 'max:5'],
                'outlets.required' => 'Please select at least one of the outlets.'
            ]);
        } else if ($this->step == 7) {
        }
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function addChild($child_name, $child_age, $child_education)
    {
        $this->validate(
            [
                'child_name' => ['required'],
                'child_age' => ['required'],
            ]
        );

        $this->childs[]  = [
            'child_name' => $child_name,
            'child_age' => $child_age,
            'child_education' => $child_education,
        ];

        $this->child_name = '';
        $this->child_age = '';
        $this->child_education = '';
    }

    public function removeChild($index)
    {
        array_splice($this->childs, $index, 1);
    }

    public function addEducation($edu, $grad_year)
    {
        $this->validate(
            [
                'edu' => ['required'],
                'grad_year' => ['required'],
            ]
        );

        $this->educations[]  = [
            'edu' => $edu,
            'grad_year' => $grad_year,
        ];

        $this->edu = '';
        $this->grad_year = '';
    }

    public function removeEducation($index)
    {
        array_splice($this->educations, $index, 1);
    }

    public function addProduct($product_nu, $product_quantity, $product_percent)
    {
        $this->validate([
            'product_nu' => [
                'required',
                Rule::exists('products', 'product_nu')->where('product_nu', $product_nu),

            ],
            'product_quantity' => ['required', 'numeric'],
            'product_percent' => ['required', 'numeric'],
        ]);
        $prod = Product::where('product_nu', '=', $product_nu)->first();

        $this->products[]  = [
            'product_nu' => $product_nu,
            'product_name' => $prod->name,
            'product_price' => $prod->price,
            'product_quantity' => $product_quantity,
            'product_percent' => $product_percent,
        ];
        $this->product_nu = '';
        $this->product_name = '';
        $this->product_price = '';
        $this->product_quantity = '';
        $this->product_percent = '';
    }

    public function removeProduct($index)
    {
        array_splice($this->products, $index, 1);
    }

    public function addCompetitorProduct($competitor_product_name)
    {
        $this->validate(
            [
                'competitor_product_name' => ['required'],
            ]
        );
        $this->competitor_products[]  = [
            'product_name' => $competitor_product_name,
        ];

        $this->competitor_product_name = '';
    }

    public function removeCompetitorProduct($index)
    {
        array_splice($this->competitor_products, $index, 1);
    }

    public function addOutlet($outlet_nu_uni)
    {
        $this->validate([
            'outlet_name' => [
                'required',
            ],
        ]);
        $out = Outlet::where('outlet_nu_uni', '=', $outlet_nu_uni)->first();
        if (is_null($out) || $out->outlet_nu_uni == "") {
            $this->outlets[]  = [
                'outlet_nu' => 'New',
                'outlet_name' => $this->outlet_name,
                'outlet_address' => 'New',
            ];
        } else {
            $this->outlets[]  = [
                'outlet_nu' => $outlet_nu_uni,
                'outlet_name' => $out->name_uni,
                'outlet_address' => $out->address_uni,
            ];
        }
        $this->outlet_nu = '';
        $this->outlet_name = '';
        $this->outlet_address = '';
    }

    public function removeOutlet($index)
    {
        array_splice($this->outlets, $index, 1);
    }

    public function submit()
    {
        $biodata = new Biodata();
        $biodata->biodata_type = 1;
        $biodata->status = '1';
        $biodata->username = $this->user_username;
        $biodata->name = $this->name;
        $biodata->address = $this->address;

        $data = array(
            'specialty' => $this->specialty,
            'gender' => $this->gender,
            'birthplace' => $this->birthplace,
            'birthdate' => $this->birthdate,
            'religion' => $this->religion,
            'marital_status' => $this->marital_status,
            'hobby' => $this->hobby,
            'phone' => $this->phone,
            'mobile_phone' => $this->mobile_phone,
            'spouse' => $this->spouse,
            'childs' => $this->childs,
            'educations' => $this->educations,
            'workplace' => $this->workplace,
            'work_address' => $this->work_address,
            'work_phone' => $this->work_phone,
            'fax' => $this->fax,
            'patients_per_day' => $this->patients_per_day,
            'products' => $this->products,
            'competitor_products' => $this->competitor_products,
            'outlets' => $this->outlets,
            'notes' => $this->notes
        );

        $biodata->additional_details = json_encode($data);;
        $biodata->created_by = Auth::user()->username;
        $biodata->save();

        return redirect('/lampiran');
    }
}
