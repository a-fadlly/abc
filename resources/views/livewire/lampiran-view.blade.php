<div>
    <div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
        <div class="mt-4">
            <div class="flex flex-wrap justify-between text-sm">
                <div class="w-1/2 p-4 text-left">
                    <a class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                        href="{{ url()->previous() }}"><i class="fa fa-arrow-left w-4 h-4 mr-2"></i>Back</a>
                    <a class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                        href="/lampiran/{{ $lampirans[0]->lampiran_nu }}/print"><i
                            class="fa fa-print w-4 h-4 mr-2"></i>Print</a>
                </div>
                @if ($toast)
                    <div class="flex items-center p-5">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-8 h-8 {{ $toast == 'Rejected' ? 'text-red-600' : 'text-green-600' }}"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p
                            class="ml-3 text-sm font-bold {{ $toast == 'Rejected' ? 'text-red-600' : 'text-green-600' }}">
                            {{ $toast }}
                        </p>
                    </div>
                @endif
                @if ($buttonVisible)
                    <div class="w-1/2 p-4 text-right">
                        <button
                            class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                            wire:click="approve({{ $lampirans[0]->lampiran_nu }})">
                            <span style="color: Green;">
                                <i class="fa fa-check w-4 h-4 mr-2"></i>Approve
                            </span>
                        </button>
                        <button
                            class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                            wire:click="reject({{ $lampirans[0]->lampiran_nu }})">
                            <span style="color: Red;">
                                <i class="fa fa-ban w-4 h-4 mr-2"></i>Reject
                            </span>
                        </button>
                    </div>
                @endif

            </div>
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
                        <td scope="col" class="px-4">: {{ $lampirans[0]->user->name }}</td>
                        <td scope="col" class="px-4">MR ID</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->user->username }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">MD ID</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->doctor->doctor_nu }}</td>
                        <td scope="col" class="px-4">MR Name</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->user->name }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">MD Name</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->doctor->name }}</td>
                        <td scope="col" class="px-4">Rayon / Area</td>
                        <td scope="col" class="px-4">: Palu / Makasar + Pare Pare + Manado</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">Tgl Ajuan</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->periode }}</td>
                        <td scope="col" class="px-4">Reg / Divisi</td>
                        <td scope="col" class="px-4">: Regional 5</td>
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
                        function idr($num)
                        {
                            return number_format($num, 2, ',', '.');
                        }
                        $distinct_products = $lampirans->unique(function ($product) {
                            return $product->product_nu . '-' . $product->product_nu;
                        });
                        $total_value_sum = 0;
                        $total_value_cicilan_sum = 0;
                    @endphp
                    @foreach ($distinct_products as $product)
                        @php
                            $value_cicilan = $product->sales * ($product->percent / 100);
                            
                            $total_value_sum = $total_value_sum + $product->sales;
                            $total_value_cicilan_sum = $total_value_cicilan_sum + $value_cicilan;
                        @endphp
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $product->product_nu }}</td>
                            <td class="px-4 py-2">{{ $product->product->name }}</td>
                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                            <td class="px-4 py-2">{{ idr($product->product->price) }}</td>
                            <td class="px-4 py-2">{{ idr($product->sales) }}</td>
                            <td class="px-4 py-2">{{ $product->percent }}</td>
                            <td class="px-4 py-2">{{ idr($value_cicilan) }}</td>
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
                        <th scope="col" class="px-4 py-2">{{ idr($total_value_cicilan_sum) }}
                        </th>
                        <th scope="col" class="px-4 py-2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @php
            $outlets = $lampirans->unique(function ($outlet) {
                return $outlet->outlet_nu . '-' . $outlet->outlet_nu;
            });
        @endphp
        <div class="mt-3 mb-3">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Outlet Nu</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlets as $outlet)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $outlet->outlet->outlet_nu }}</td>
                            <td class="px-4 py-2">{{ $outlet->outlet->name }}</td>
                            <td class="px-4 py-2">{{ $outlet->outlet->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($logs as $index => $log)
        <div class="p-3 mt-3 mb-3 bg-white rounded shadow-xl overflow-x-auto text-center text-sm">
            {{ $log['action_type'] }} by <b>{{ $log['name'] }}</b> at {{ $log['created_at'] }}
        </div>
    @endforeach
</div>
