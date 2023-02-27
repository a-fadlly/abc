<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Outlet;
use App\Models\Product;
use Livewire\Component;
use App\Models\Lampiran;
use App\Models\ActionLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WizardUpdateLampiran extends Component
{
    public $step = 1;
    public $lampiran_nu = '';
    public $user;
    public $name; //id
    public $doctor; //id
    public $product; //id
    public $outlet; //id
    public $quantity;
    public $percent;
    public $products;
    public $outlets;

    //test
    public $ids;

    public $nameplaceholder;
    public $doctorplaceholder;

    public $suggestions;

    public function mount()
    {
        $this->suggestions = [];
        $this->products = collect([]);
        $this->outlets = collect([]);

        $ids = User::where('reporting_manager', '=', Auth::id())
            ->pluck('id')
            ->toArray();
        foreach ($ids as $id) {
            array_push($ids, User::where('reporting_manager', '=', $id)
                ->pluck('id')
                ->toArray());
        }

        $this->ids = flattenArray($ids);
    }

    public function getLampiranNu()
    {
        $this->lampiran_nu = Lampiran::where(['user_id' => $this->name, 'doctor_nu' => $this->doctor])->pluck('lampiran_nu')->first();
    }

    public function loadProductsAndOutlets()
    {
        $products = Lampiran::join('products', 'products.product_nu', '=', 'lampirans.product_nu')
            ->where('lampirans.is_expired', '=', 0)
            ->where('lampirans.status', '=', 4)
            ->select('lampirans.lampiran_nu', 'lampirans.product_nu', 'products.name', 'products.price', 'lampirans.quantity', 'lampirans.percent', DB::raw('quantity * price as value'), DB::raw('(quantity * price) * (percent/100) as valueCicilan'), DB::raw('0 as is_deleted'), DB::raw('0 as newly_created'))
            ->distinct()
            ->get();
        $this->products = collect($products);

        $outlets = Lampiran::join('outlets', 'outlets.outlet_nu', '=', 'lampirans.outlet_nu')
            ->where('lampirans.is_expired', '=', 0)
            ->where('lampirans.status', '=', 4)
            ->select('lampirans.outlet_nu', 'outlets.name', 'outlets.address', DB::raw('0 as is_deleted'), DB::raw('0 as newly_created'))
            ->distinct()
            ->get();
        $this->outlets = collect($outlets);
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
            $this->suggestions = User::distinct()
                ->select('users.id', 'users.name', 'users.username')
                ->join('lampirans', 'users.id', '=', 'lampirans.user_id')
                ->whereIn('lampirans.user_id', $this->ids)
                ->where(function ($query) {
                    $query
                        ->where('users.username', 'like', "%{$this->nameplaceholder}%")
                        ->orWhere('users.name', 'like', "%{$this->nameplaceholder}%");
                })
                ->where('role_id', '<', Auth::user()->role_id)
                ->take(10)
                ->get();
        } elseif ($this->step === 2) {
            if (strlen($this->doctorplaceholder) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Doctor::distinct()
                ->select('doctors.doctor_nu', 'doctors.name', 'doctors.address')
                ->join('lampirans', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
                ->join('users', 'lampirans.user_id', '=', 'users.id')
                ->where('lampirans.user_id', $this->name)
                ->where(function ($query) {
                    $query
                        ->where('doctors.doctor_nu', 'like', "%{$this->doctorplaceholder}%")
                        ->orWhere('doctors.name', 'like', "%{$this->doctorplaceholder}%");
                })
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
            $this->getLampiranNu();
            $this->loadProductsAndOutlets();
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
        $this->validate(
            [
                'product' => [
                    'required',
                    Rule::exists('products', 'product_nu')->where('product_nu', $product),
                    Rule::notIn($this->products->where('is_deleted', 0)->pluck('product_nu')->toArray())
                ],
                'quantity' => ['required', 'numeric'],
                'percent' => ['required', 'numeric', 'min:1', 'max:100']
            ],
            [
                'product.not_in' => 'Product already exists, please remove the old ones first.',
            ]
        );

        $prod = Product::where('product_nu', '=', $product)->first();
        $valueCicilan = ($quantity * $prod->price) * ($percent / 100);

        $newProduct = [
            'product_nu' => $product,
            'name' => $prod->name,
            'quantity' => $quantity,
            'price' => $prod->price,
            'value' => $quantity * $prod->price,
            'percent' => $percent,
            'valueCicilan' => $valueCicilan,
            'newly_created' => 1,
            'is_deleted' => 0,
        ];

        $this->products->push($newProduct);
        $this->product = '';
        $this->quantity = '';
        $this->percent = '';
    }

    public function addOutlet($outlet)
    {
        $this->validate(
            [
                'outlet' => [
                    'required', Rule::exists('outlets', 'outlet_nu')->where('outlet_nu', $outlet),
                    Rule::notIn($this->outlets->where('is_deleted', 0)->pluck('outlet_nu')->toArray())
                ],
            ],
            [
                'outlet.not_in' => 'Outlets already exists.',
            ]
        );
        $out = Outlet::where('outlet_nu', '=', $outlet)->first();
        $newOutlet = [
            'outlet_nu' => $out->outlet_nu,
            'name' => $out->name,
            'address' => $out->address,
            'newly_created' => 1,
            'is_deleted' => 0,
        ];
        $this->outlets->push($newOutlet);
        $this->outlet = '';
    }

    public function removeProduct($index)
    {
        $product = $this->products->get($index);
        $product['newly_created'] = 0;
        $product['is_deleted'] = 1;
        $this->products->put($index, $product);
    }

    public function removeOutlet($index)
    {
        $outlet = $this->outlets->get($index);
        $outlet['newly_created'] = 0;
        $outlet['is_deleted'] = 1;
        $this->outlets->put($index, $outlet);
    }

    public function render()
    {
        return view('livewire.wizard-update-lampiran');
    }

    public function submit()
    {
        $now = Carbon::now();
        foreach ($this->outlets as $outlet) {
            if ($outlet['is_deleted'] && !$outlet['newly_created']) { //test
                Lampiran::where([
                    'user_id' => $this->name,
                    'lampiran_nu' => $this->lampiran_nu,
                    'outlet_nu' => $outlet['outlet_nu']
                ])
                    ->update(['is_expired' => 1, 'status' => 1]);
            }
            foreach ($this->products as $product) {
                if ($product['is_deleted'] && !$outlet['newly_created']) { //test
                    Lampiran::where([
                        'user_id' => $this->name,
                        'lampiran_nu' => $this->lampiran_nu,
                        'product_nu' => $product['product_nu']
                    ])
                        ->update(['is_expired' =>
                        1, 'status' => 1]);
                }
                if (!$outlet['is_deleted'] && $product['newly_created'] && !$product['is_deleted']) {
                    $lampiran = new Lampiran();
                    $lampiran->lampiran_nu = $this->lampiran_nu;
                    $lampiran->user_id = $this->name;
                    $lampiran->status = 1;
                    $lampiran->periode = $now;
                    $lampiran->doctor_nu = $this->doctor;
                    $lampiran->outlet_nu = $outlet['outlet_nu'];
                    $lampiran->product_nu = $product['product_nu'];
                    $lampiran->quantity = $product['quantity'];
                    $lampiran->percent = $product['percent'];
                    $lampiran->sales = $product['value'];
                    $lampiran->is_expired = 0;
                    $lampiran->created_by = Auth::id();
                    $lampiran->save();
                }
            }
        }

        $data = array('doctor' => $this->doctor, 'products' => $this->products, 'outlets' => $this->outlets);
        $action_log = new ActionLog();
        $action_log->action_type = "Updated";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $this->lampiran_nu;
        $action_log->user_id = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = json_encode($data);
        $action_log->save();
        return redirect('/lampiran');
    }
}
