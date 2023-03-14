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
use Illuminate\Support\Facades\Session;

class WizardUpdateLampiran extends Component
{
    public $step = 1;
    public $lampiran_nu = '';
    public $user;
    public $username; //id
    public $doctor_nu;
    public $product_nu;
    public $outlet_nu;
    public $price_at_that_time;
    public $quantity;
    public $percent;
    public $products;
    public $outlets;

    //test
    public $usernames;

    public $nameplaceholder;
    public $doctorplaceholder;

    public $suggestions;

    public function mount()
    {
        $this->suggestions = [];
        $this->products = collect([]);
        $this->outlets = collect([]);

        // $this->usernames = User::where('reporting_manager', '=', Auth::user()->username)
        //     ->orWhere('reporting_manager_manager', '=', Auth::user()->username)
        //     ->pluck('username')
        //     ->toArray();
        $this->usernames = Session::get('usernames');

    }

    public function getLampiranNu()
    {
        $this->lampiran_nu = Lampiran::where(['username' => $this->username, 'doctor_nu' => $this->doctor_nu])->pluck('lampiran_nu')->first();
    }

    public function loadProductsAndOutlets()
    {
        $products = Lampiran::join('products', 'products.product_nu', '=', 'lampirans.product_nu')
            ->where('lampirans.is_expired', '=', 0)
            ->where('lampirans.status', '=', 4)
            ->where('lampirans.lampiran_nu', '=', $this->lampiran_nu)
            ->where('lampirans.username', '=', $this->username)
            ->where('lampirans.doctor_nu', '=', $this->doctor_nu)
            ->select(
                'lampirans.lampiran_nu',
                'lampirans.product_nu',
                'products.name',
                'lampirans.price_at_that_time',
                'lampirans.quantity',
                'lampirans.percent',
                DB::raw('lampirans.quantity as prev_quantity'),
                DB::raw('lampirans.percent as prev_percent'),
                DB::raw('quantity * price_at_that_time as value'),
                DB::raw('Sales as valueCicilan'),
                DB::raw('0 as is_edited'),
                DB::raw('0 as is_deleted'),
                DB::raw('0 as newly_created')
            )
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

    public function updatedDoctorNu()
    {
        $this->search();
    }

    public function updatedProductNu()
    {
        $this->search();
    }

    public function updatedOutletNu()
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
                ->select('users.username', 'users.name', 'users.username')
                ->join('lampirans', 'users.username', '=', 'lampirans.username')
                ->whereIn('lampirans.username', $this->usernames)
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query
                            ->where('users.username', 'like', "%{$this->nameplaceholder}%")
                            ->where('users.name', 'not like', "%VACANT%")
                            ->where('users.name', 'not like', "%AKTIF%");
                    })->orWhere(function ($query) {
                        $query
                            ->where('users.name', 'like', "%{$this->nameplaceholder}%")
                            ->where('users.name', 'not like', "%VACANT%")
                            ->where('users.name', 'not like', "%AKTIF%");
                    });
                })
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
                ->join('users', 'lampirans.username', '=', 'users.username')
                ->where('lampirans.username', $this->username)
                ->where(function ($query) {
                    $query
                        ->where('doctors.doctor_nu', 'like', "%{$this->doctorplaceholder}%")
                        ->orWhere('doctors.name', 'like', "%{$this->doctorplaceholder}%");
                })
                ->take(10)
                ->get();
        } elseif ($this->step === 3) {
            if (strlen($this->product_nu) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Product::where('product_nu', 'like', "%{$this->product_nu}%")
                ->orWhere('name', 'like', "%{$this->product_nu}%")
                ->take(10)
                ->get();
        } elseif ($this->step === 4) {
            if (strlen($this->outlet_nu) < 1) {
                $this->suggestions = [];
                return;
            }
            $this->suggestions = Outlet::where('outlet_nu', 'like', "%{$this->outlet_nu}%")
                ->orWhere('name', 'like', "%{$this->outlet_nu}%")
                ->take(10)
                ->get();
        }
    }

    public function setValues($value)
    {
        if ($this->step === 1) {
            $this->username = $value;
            $user = User::where('username', '=', $value)->first();
            $this->nameplaceholder = $user->name;
            $this->user = $user;
        } elseif ($this->step === 2) {
            $this->doctor_nu = $value;
            $doctor = Doctor::where('doctor_nu', '=', $value)->first();
            $this->doctorplaceholder = $doctor->name;
            $this->getLampiranNu();
            $this->loadProductsAndOutlets();
        } elseif ($this->step === 3) {
            $this->product_nu = $value;
            $prod = Product::where('product_nu', '=', $value)->first();
            $this->price_at_that_time = $prod->price;
        } elseif ($this->step === 4) {
            $this->outlet_nu = $value;
        }
        $this->suggestions = [];
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'username' => ['required', Rule::exists('users', 'username')->where('username', $this->username)],
            ]);
        } elseif ($this->step == 2) {
            $this->validate(
                [
                    'doctor_nu' => [
                        'required', Rule::exists('lampirans', 'doctor_nu')
                            ->where('lampiran_nu', $this->lampiran_nu)
                            ->where('username', $this->username)
                            ->where('doctor_nu', $this->doctor_nu)
                    ],
                ],
                [
                    'doctor_nu.exists' => 'Product is already exists or in progress, please remove or finish the old ones first.',
                ]
            );
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

    public function addProduct()
    {
        $this->validate(
            [
                'product_nu' => [
                    'required',
                    Rule::exists('products', 'product_nu')->where('product_nu', $this->product_nu),
                    Rule::notIn($this->products->where('is_deleted', 0)->pluck('product_nu')->toArray()),
                    Rule::notIn(Lampiran::where('lampiran_nu', $this->lampiran_nu)
                        ->where('is_expired', 0)
                        ->whereIn('status', [1, 2, 4])
                        ->pluck('product_nu')->toArray()),
                ],
                'quantity' => ['required', 'numeric'],
                'percent' => ['required', 'numeric', 'min:1', 'max:100']
            ],
            [
                'product_nu.not_in' => 'Product is already exists or in progress, please remove or finish the old ones first.',
            ]
        );

        $prod = Product::where('product_nu', '=', $this->product_nu)->first();
        $valueCicilan = ($this->quantity * $prod->price) * ($this->percent / 100);

        $newProduct = [
            'product_nu' => $this->product_nu,
            'name' => $prod->name,
            'quantity' => $this->quantity,
            'price_at_that_time' => $this->price_at_that_time,
            'value' => $this->quantity * $prod->price,
            'percent' => $this->percent,
            'valueCicilan' => $valueCicilan,
            'newly_created' => 1,
            'is_deleted' => 0,
        ];

        $this->products->push($newProduct);
        $this->product_nu = '';
        $this->price_at_that_time = '';
        $this->quantity = '';
        $this->percent = '';
    }

    public function addOutlet()
    {
        $this->validate(
            [
                'outlet_nu' => [
                    'required', Rule::exists('outlets', 'outlet_nu')->where('outlet_nu', $this->outlet_nu),
                    Rule::notIn($this->outlets->where('is_deleted', 0)->pluck('outlet_nu')->toArray())
                ],
            ],
            [
                'outlet_nu.not_in' => 'Outlets already exists.',
            ]
        );
        $out = Outlet::where('outlet_nu', '=', $this->outlet_nu)->first();
        $newOutlet = [
            'outlet_nu' => $out->outlet_nu,
            'name' => $out->name,
            'address' => $out->address,
            'newly_created' => 1,
            'is_deleted' => 0,
        ];
        $this->outlets->push($newOutlet);
        $this->outlet_nu = '';
    }

    public function removeProduct($index)
    {
        $product = $this->products->get($index);
        $product['is_deleted'] = 1;
        $this->products->put($index, $product);
    }

    public function removeOutlet($index)
    {
        $outlet = $this->outlets->get($index);
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
                    'username' => $this->username,
                    'lampiran_nu' => $this->lampiran_nu,
                    'outlet_nu' => $outlet['outlet_nu']
                ])->update([
                    'is_expired' => 1,
                    'status' => 1
                ]);
            }
            foreach ($this->products as $product) {
                if (isset($product['is_edited']) && !$outlet['is_deleted']) { //test
                    Lampiran::where([
                        'username' => $this->username,
                        'lampiran_nu' => $this->lampiran_nu,
                        'product_nu' => $product['product_nu'],
                        'is_expired' => false
                    ])->update([
                        'quantity' => $product['quantity'],
                        'percent' => $product['percent'],
                        'status' => 1
                    ]);
                }
                if ($product['is_deleted'] && !$outlet['newly_created']) { //test
                    Lampiran::where([
                        'username' => $this->username,
                        'lampiran_nu' => $this->lampiran_nu,
                        'product_nu' => $product['product_nu']
                    ])->update([
                        'is_expired' => 1,
                        'status' => 1
                    ]);
                }
                if (!$outlet['is_deleted'] && $product['newly_created'] && !$product['is_deleted']) {
                    $lampiran = new Lampiran();
                    $lampiran->lampiran_nu = $this->lampiran_nu;
                    $lampiran->username = $this->username;
                    $lampiran->status = 1;
                    $lampiran->doctor_nu = $this->doctor_nu;
                    $lampiran->outlet_nu = $outlet['outlet_nu'];
                    $lampiran->product_nu = $product['product_nu'];
                    $lampiran->price_at_that_time = $product['price_at_that_time'];
                    $lampiran->quantity = $product['quantity'];
                    $lampiran->percent = $product['percent'];
                    $lampiran->sales = $product['value'];
                    $lampiran->is_expired = 0;
                    $lampiran->created_by = Auth::user()->username;
                    $lampiran->save();
                }
            }
        }

        $data = array('doctor' => $this->doctor_nu, 'products' => $this->products, 'outlets' => $this->outlets);
        $action_log = new ActionLog();
        $action_log->action_type = "Updated";
        $action_log->target_type = "Lampiran";
        $action_log->target_id = $this->lampiran_nu;
        $action_log->username = Auth::id();
        $action_log->name = Auth::user()->name;
        $action_log->note = json_encode($data);
        $action_log->save();
        return redirect('/lampiran');
    }

    public function updateProductQuantity($index, $quantity)
    {
        $product = $this->products[$index];
        $product['is_edited'] = 1;
        $product['quantity'] = $quantity;
        $product['value'] = $product['price_at_that_time'] * $quantity;
        $this->products[$index] = $product;

        $this->emit('updateTotalValue');
        $this->emit('updateTotalValueCicilan');
    }

    public function updateProductPercent($index, $percent)
    {
        $product = $this->products[$index];
        $product['is_edited'] = 1;
        $product['percent'] = $percent;
        $product['valueCicilan'] = $product['value'] * $percent / 100;
        $this->products[$index] = $product;

        $this->emit('updateTotalValue');
        $this->emit('updateTotalValueCicilan');
    }

    public function getTotalValue()
    {
        $totalValue = 0;
        foreach ($this->products as $product) {
            if (!$product['is_deleted'])
                $totalValue += $product['value'];
        }
        return $totalValue;
    }

    public function getTotalValueCicilan()
    {
        $totalValueCicilan = 0;
        foreach ($this->products as $product) {
            if (!$product['is_deleted'])
                $totalValueCicilan += $product['valueCicilan'];
        }
        return $totalValueCicilan;
    }
}
