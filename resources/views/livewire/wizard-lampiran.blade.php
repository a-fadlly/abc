<div class="p-10 bg-white rounded shadow-xl">
    <div class="flex justify-between">
        <span class="text-xs text-gray-600">Step {{ $step }} of 5</span>
        <div class="flex">
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 1) font-weight: bold; @endif">1. Name</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 2) font-weight: bold; @endif">2. Doctor</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 3) font-weight: bold; @endif">3. Product</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 4) font-weight: bold; @endif">4. Outlet</span>
            <span class="text-xs text-gray-600"
                style="cursor:pointer; @if ($step === 5) font-weight: bold; @endif">5. Summary</span>
        </div>
    </div>
    @if ($step === 1)
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                wire:model="nameplaceholder" placeholder="Name">
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded absolute">
                <ul class="top-0 z-10 bg-white mt-2 rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->id }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->username }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="error">
            @error('name')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 2)
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="doctor">Doctor</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                wire:model="doctorplaceholder" placeholder="Doctor">
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded absolute">
                <ul class="top-0 z-10 bg-white mt-2 rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->doctor_nu }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->doctor_nu }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="error">
            @error('doctor')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 3)
        <div class="error">
            @error('products')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="product">Product</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="product"
                id="product" name="product" placeholder="Product">
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded z-10 absolute">
                <ul class="top-0 z-10 bg-white mt-2 rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->product_nu }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->product_nu }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('product')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="quantity">Quantity</label>
            <input type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="quantity"
                id="quantity" name="quantity" placeholder="Quantity">
            @error('quantity')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="percent">Percent (%)</label>
            <input type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="percent"
                id="percent" name="percent" placeholder="Percent">
            @error('percent')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <button class="mb-5"
                wire:click="addProduct('{{ $product }}', '{{ $quantity }}', '{{ $percent }}')">
                <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    Product
                </span>
            </button>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Product nu</th>
                        <th scope="col" class="px-4 py-2">Product</th>
                        <th scope="col" class="px-4 py-2">Quantity</th>
                        <th scope="col" class="px-4 py-2">Price</th>
                        <th scope="col" class="px-4 py-2">Value</th>
                        <th scope="col" class="px-4 py-2">%</th>
                        <th scope="col" class="px-4 py-2">Value Cicilan</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_value_sum = 0;
                        $total_value_cicilan_sum = 0;
                    @endphp
                    @foreach ($products as $index => $item)
                        @php
                            $total_value_sum = $total_value_sum + $item['value'];
                            $total_value_cicilan_sum = $total_value_cicilan_sum + $item['valueCicilan'];
                        @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $item['product_nu'] }}</td>
                            <td class="px-4 py-2">{{ $item['product'] }}</td>
                            <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                            <td class="px-4 py-2">{{ idr($item['price']) }}</td>
                            <td class="px-4 py-2">{{ idr($item['value']) }}</td>
                            <td class="px-4 py-2">{{ $item['percent'] }}</td>
                            <td class="px-4 py-2">{{ idr($item['valueCicilan']) }}</td>
                            <td class="px-4 py-2">
                                <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    wire:click="removeProduct({{ $index }})">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">Total</th>
                        <th scope="col" class="px-4 py-2">{{ idr($total_value_sum) }}</th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">
                            {{ idr($total_value_cicilan_sum) }}</th>
                        <th scope="col" class="px-4 py-2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 4)
        <div class="error">
            @error('outlets')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="outlet">Outlet</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="outlet"
                id="outlet" name="outlet" placeholder="Outlet">
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded absolute z-10">
                <ul class="rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->outlet_nu }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->outlet_nu }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @error('outlet')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <button class="mb-5" wire:click="addOutlet('{{ $outlet }}')">
                <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    Outlet
                </span>
            </button>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Outlet Nu</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Address</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlets as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $item['outlet_nu'] }}</td>
                            <td class="px-4 py-2">{{ $item['name'] }}</td>
                            <td class="px-4 py-2">{{ $item['address'] }}</td>
                            <td class="px-4 py-2">
                                <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    wire:click="removeOutlet({{ $index }})">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 5)
        <div class="mt-4">
            @php
                $additional_details = json_decode($user->additional_details, true);
            @endphp
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2" colspan="3">
                            Lampiran
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col" class="px-4">FF</td>
                        <td scope="col" class="px-4">: {{ $nameplaceholder }}</td>
                        <td scope="col" class="px-4">MR ID</td>
                        <td scope="col" class="px-4">: {{ $name }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">MD ID</td>
                        <td scope="col" class="px-4">: {{ $doctor }}</td>
                        <td scope="col" class="px-4">MR Name</td>
                        <td scope="col" class="px-4">: {{ $nameplaceholder }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">MD Name</td>
                        <td scope="col" class="px-4">: {{ $doctorplaceholder }}</td>
                        <td scope="col" class="px-4">Rayon / Area</td>
                        <td scope="col" class="px-4">:
                            {{ $user->additional_details && $additional_details['rayon'] ? $additional_details['rayon'] : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4"></td>
                        <td scope="col" class="px-4"></td>
                        <td scope="col" class="px-4">Reg / Divisi</td>
                        <td scope="col" class="px-4">:
                            {{ $user->additional_details && $additional_details['regional'] ? $additional_details['regional'] : '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Product nu</th>
                        <th scope="col" class="px-4 py-2">Product</th>
                        <th scope="col" class="px-4 py-2">Quantity</th>
                        <th scope="col" class="px-4 py-2">Price</th>
                        <th scope="col" class="px-4 py-2">Value</th>
                        <th scope="col" class="px-4 py-2">%</th>
                        <th scope="col" class="px-4 py-2">Value Cicilan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_value_sum = 0;
                        $total_value_cicilan_sum = 0;
                    @endphp
                    @foreach ($products as $index => $item)
                        @php
                            $total_value_sum = $total_value_sum + $item['value'];
                            $total_value_cicilan_sum = $total_value_cicilan_sum + $item['valueCicilan'];
                        @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $item['product_nu'] }}</td>
                            <td class="px-4 py-2">{{ $item['product'] }}</td>
                            <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                            <td class="px-4 py-2">{{ idr($item['price']) }}</td>
                            <td class="px-4 py-2">{{ idr($item['value']) }}</td>
                            <td class="px-4 py-2">{{ $item['percent'] }}</td>
                            <td class="px-4 py-2">{{ idr($item['valueCicilan']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">Total</th>
                        <th scope="col" class="px-4 py-2">{{ idr($total_value_sum) }}
                        </th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">
                            {{ idr($total_value_cicilan_sum) }}</th>
                        <th scope="col" class="px-4 py-2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="mt-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Outlet Nu</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlets as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $item['outlet_nu'] }}</td>
                            <td class="px-4 py-2">{{ $item['name'] }}</td>
                            <td class="px-4 py-2">{{ $item['address'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-green-600 rounded-lg outline-none hover:bg-green-700 ring-green-400"
                wire:click="submit">Submit</button>
        </div>
    @endif
    <script>
        window.addEventListener("beforeunload", function(e) {
            var confirmationMessage = "Are you sure you want to leave the page without submitting the form?";
            (e || window.event).returnValue = confirmationMessage;
            return confirmationMessage;
        });
    </script>
</div>
