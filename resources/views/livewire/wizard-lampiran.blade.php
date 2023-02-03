<div class="p-10 bg-white rounded shadow-xl">
    <div class="flex justify-between">
        <span class="text-xs text-gray-600">Step {{ $step }} of 4</span>
        <div class="flex">
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 1) font-weight: bold; @endif">1. Name</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 2) font-weight: bold; @endif">2. Address</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 3) font-weight: bold; @endif">3. Product</span>
            <span class="text-xs text-gray-600"
                style="cursor:pointer; @if ($step === 4) font-weight: bold; @endif">4. Summary</span>
        </div>
    </div>
    @if ($step === 1)
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="name"
                placeholder="Name">
            {{-- suggestions --}}
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white border border-gray-400 rounded absolute">
                @foreach ($suggestions as $suggestion)
                    <li wire:click="setValues('{{ $suggestion->id }}'); $set('suggestions', [])"
                        class="p-2 hover:bg-gray-200 cursor-pointer">
                        {{ $suggestion->id }} - {{ $suggestion->name }}
                    </li>
                @endforeach
                </ul>
            </div>
            {{-- end of suggestions --}}
        </div>
        <div class="error">
            @error('name')
                <div class="w-100 text-red-500 italic mt-4">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-4">
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 2)
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="address">Address</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="address"
                placeholder="Address">
            {{-- suggestions --}}
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white border border-gray-400 rounded absolute">
                @foreach ($suggestions as $suggestion)
                    <li wire:click="setValues('{{ $suggestion->id }}'); $set('suggestions', [])"
                        class="p-2 hover:bg-gray-200 cursor-pointer">
                        {{ $suggestion->id }} - {{ $suggestion->name }}
                    </li>
                @endforeach
                </ul>
            </div>
            {{-- end of suggestions --}}
        </div>
        <div class="error">
            @error('address')
                <div class="w-100 text-red-500 italic mt-4">{{ $message }}</div>
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
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="product">Product</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="product"
                id="product" name="product" placeholder="Product">
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white border border-gray-400 rounded absolute">
                @foreach ($suggestions as $suggestion)
                    <li wire:click="setValues('{{ $suggestion->product_nu }}'); $set('suggestions', [])"
                        class="p-2 hover:bg-gray-200 cursor-pointer">
                        {{ $suggestion->product_nu }} - {{ $suggestion->name }}
                    </li>
                @endforeach
                </ul>
            </div>
            @error('product')
                <div class="w-100 text-red-500 italic mt-4">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="quantity">Quantity</label>
            <input type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="quantity"
                id="quantity" name="quantity" placeholder="Quantity">
            @error('quantity')
                <div class="w-100 text-red-500 italic mt-4">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="percent">Percent (%)</label>
            <input type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" wire:model="percent"
                id="percent" name="percent" placeholder="Percent">
            @error('percent')
                <div class="w-100 text-red-500 italic mt-4">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            <button class="mb-5"
                wire:click="addProduct('{{ $product }}', '{{ $quantity }}','{{ $percent }}')">
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
                            <td class="px-4 py-2">{{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ number_format($item['value'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $item['percent'] }}</td>
                            <td class="px-4 py-2">{{ number_format($item['valueCicilan'], 0, ',', '.') }}</td>
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
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">{{ number_format($total_value_sum, 0, ',', '.') }}</th>
                        <th scope="col" class="px-4 py-2"></th>
                        <th scope="col" class="px-4 py-2">
                            {{ number_format($total_value_cicilan_sum, 0, ',', '.') }}</th>
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
        <div class="mt-2">
            <p>Name: {{ $name }}</p>
            <p>Address: {{ $address }}</p>
            <p>Products:</p>
            <ul>
                @foreach ($products as $item)
                    <li>{{ $item['product'] }} ({{ $item['quantity'] }})</li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-green-600 rounded-lg outline-none hover:bg-green-700 ring-green-400"
                wire:click="submit">Submit</button>
        </div>
    @endif
</div>
