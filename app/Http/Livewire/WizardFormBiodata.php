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
        switch ($this->step) {
            case 1:
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
                break;

            case 5:
                if (strlen($this->product_name) < 1) {
                    $this->suggestions = [];
                    return;
                }
                $this->suggestions = Product::where('product_nu', 'like', "%{$this->product_name}%")
                    ->orWhere('name', 'like', "%{$this->product_name}%")
                    ->take(10)
                    ->get();
                break;

            case 6:
                if (strlen($this->outlet_name) < 1) {
                    $this->suggestions = [];
                    return;
                }
                $this->suggestions = Outlet::where('outlet_nu', 'like', "%{$this->outlet_name}%")
                    ->orWhere('name', 'like', "%{$this->outlet_name}%")
                    ->take(10)
                    ->get();
                break;
        }
    }

    public function setValues($value)
    {
        switch ($this->step) {
            case 1:
                $user = User::where('username', '=', $value)->firstOrFail();
                $this->user_username = $user->username;
                $this->user_name = $user->name;
                break;

            case 5:
                $prod = Product::where('product_nu', '=', $value)->firstOrFail();
                $this->product_nu = $prod->product_nu;
                $this->product_name = $prod->name;
                $this->product_price = $prod->price;
                break;

            case 6:
                $out = Outlet::where('outlet_nu_uni', '=', $value)->firstOrFail();
                $this->outlet_nu = $value;
                $this->outlet_name = $out->name_uni;
                $this->outlet_address = $out->address_uni;
                break;

            default:
                break;
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
        switch ($this->step) {
            case 1:
                break;
            case 2:
                $this->validate([
                    'name' => 'required',
                    'specialty' => 'required',
                    'address' => 'required'
                ]);
                break;
            case 5:
                $this->validate([
                    'products' => ['required', 'array', 'min:1', 'max:5'],
                    'products.required' => 'Please select at least one of the products.'
                ]);
                break;
            case 6:
                $this->validate([
                    'outlets' => ['required', 'array', 'min:1', 'max:5'],
                    'outlets.required' => 'Please select at least one of the outlets.'
                ]);
                break;
            case 3: // Not sure about the logic inside this so leaving it as it is.
            case 4: // Not sure about the logic inside this so leaving it as it is.
            case 7: // Not sure about the logic inside this so leaving it as it is.
            default:
                break;
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
        $data = [
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
            'notes' => $this->notes,
        ];

        $biodata = new Biodata();
        $biodata->biodata_type = 1;
        $biodata->status = '1';
        $biodata->username = $this->user_username;
        $biodata->name = $this->name;

        $biodata->address = $this->address;

        $biodata->additional_details = json_encode($data);

        $biodata->created_by = Auth::user()->username;
        $biodata->save();

        return redirect('/lampiran');
    }
}
