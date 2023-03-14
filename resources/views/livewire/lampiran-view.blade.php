<div>
    <div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
        <div class="mt-4">
            <div class="flex flex-wrap justify-between text-sm">
                <div class="w-1/2 p-4 text-left">
                    <a class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                        href="{{ ($view_type == 'in_progress' ? '/lampiran/in_progress' : $view_type == 'history') ? '/lampiran/history' : '/lampiran/requisition' }}"><i
                            class="fa fa-arrow-left w-4 h-4 mr-2"></i>Back
                    </a>
                    @if (in_array($view_type, ['in_progress', 'history']))
                        <a class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                            href="/lampiran/{{ $view_type == 'in_progress' ? 'in_progress' : 'history' }}/{{ $lampirans[0]->lampiran_nu }}/print"><i
                                class="fa fa-print w-4 h-4 mr-2"></i>Print
                        </a>
                    @endif
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
                @if ($button_visible)
                    <div class="w-1/2 p-4 text-right">
                        <button
                            class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                            wire:click="approve();">
                            <span style="color: Green;">
                                <i class="fa fa-check w-4 h-4 mr-2"></i>Approve
                            </span>
                        </button>
                        <button
                            class="bg-grey-light hover:bg-grey text-grey-darkest py-2 px-4 rounded inline-flex items-center"
                            wire:click="reject();">
                            <span style="color: Red;">
                                <i class="fa fa-ban w-4 h-4 mr-2"></i>Reject
                            </span>
                        </button>
                    </div>
                @endif
            </div>
            @php
                $additional_details = json_decode($lampirans[0]->user->additional_details, true);
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
                        <td scope="col" class="px-4">ID MD</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->doctor->doctor_nu }}</td>
                        <td scope="col" class="px-4">ID MR</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->user->username }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">NAMA MD</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->doctor->name }}</td>
                        <td scope="col" class="px-4">NAMA MR</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->user->name }}</td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4">RSM</td>
                        <td scope="col" class="px-4">: {{ $lampirans[0]->createdBy->name }}</td>
                        <td scope="col" class="px-4">RAYON/AREA</td>
                        <td scope="col" class="px-4">:
                            {{ $lampirans[0]->user->additional_details && $additional_details['rayon'] ? $additional_details['rayon'] : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" class="px-4"></td>
                        <td scope="col" class="px-4"></td>
                        <td scope="col" class="px-4">REG/DIVISI</td>
                        <td scope="col" class="px-4">:
                            {{ $lampirans[0]->user->additional_details && $additional_details['regional'] ? $additional_details['regional'] : '' }}
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
                        $distinct_products = $lampirans->unique(function ($product) {
                            return $product->product_nu . '-' . $product->quantity . '-' . $product->is_expired;
                        });
                        // ->filter(function ($product) {
                        //     if ($product->status == 4) {
                        //         return $product['is_expired'] == 0;
                        //     }
                        // });
                        $total_value_sum = 0;
                        $total_value_cicilan_sum = 0;
                    @endphp
                    @foreach ($distinct_products as $product)
                        @php
                            $value_cicilan = $product->sales * ($product->percent / 100);
                            if (!$product->is_expired) {
                                $total_value_sum = $total_value_sum + $product->sales;
                                $total_value_cicilan_sum = $total_value_cicilan_sum + $value_cicilan;
                            }
                        @endphp
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 {{ $product['is_expired'] == 1 ? 'bg-red-200 line-through table-row' : '' }}">
                            <td class="px-4 py-2">{{ $product->product_nu }}</td>
                            <td class="px-4 py-2">{{ $product->product->name ?? $product->product_nu }}</td>
                            <td class="px-4 py-2">{{ $product->quantity }}</td>
                            <td class="px-4 py-2">{{ isset($product->product->price) ? idr($product->product->price) : 0 }}</td>
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
                        <th scope="col" class="px-4 py-2">{{ idr($total_value_cicilan_sum) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        @php
            $distinct_outlets = $lampirans->unique(function ($outlet) {
                return $outlet->outlet_nu;
            });
            // ->sort(function ($a, $b) {
            //     return $a['is_expired'] <=> $b['is_expired'];
            // })
            // ->filter(function ($outlet) {
            //     if ($outlet->status == 4) {
            //         return $outlet['is_expired'] == 0 && $outlet['status'] == 4;
            //     }
            // });
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
                    @foreach ($distinct_outlets as $outlet)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 {{ $outlet['is_expired'] == 1 ? 'bg-red-200 line-through table-row' : '' }}">
                            <td class="px-4 py-2">{{ $outlet->outlet->outlet_nu }}</td>
                            <td class="px-4 py-2">{{ $outlet->outlet->name }}</td>
                            <td class="px-4 py-2">{{ $outlet->outlet->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($logs as $log)
        @if ($log['action_type'] == 'Updated')
            @php
                $log_note = json_decode($log->note, true);
            @endphp
            <div class="w-1/2 p-3 mt-3 mb-3 bg-white rounded shadow-xl overflow-x-auto text-xs">
                <details class="open:row-span-2">
                    <summary>{{ $log['action_type'] }} by <b>{{ $log['name'] }}</b> at {{ $log['created_at'] }}
                    </summary>
                    @foreach ($log_note['products'] as $prod)
                        @if ($prod['newly_created'] == 1)
                            <p>Menambah produk {{ $prod['product_nu'] }} - {{ $prod['name'] }}</p>
                        @endif
                        @if ($prod['is_deleted'] == 1)
                            <p>Menghapus produk {{ $prod['product_nu'] }} - {{ $prod['name'] }}</p>
                        @endif
                        @if (isset($prod['is_edited']) &&
                                $prod['is_edited'] == 1 &&
                                isset($prod['prev_quantity']) &&
                                !($prod['prev_quantity'] == $prod['quantity']))
                            <p>Merubah quantity {{ $prod['product_nu'] }} dari {{ $prod['prev_quantity'] }} menjadi
                                {{ $prod['quantity'] }}</p>
                        @endif
                    @endforeach
                    @foreach ($log_note['outlets'] as $out)
                        @if ($out['newly_created'] == 1)
                            <p>Menambah outlet {{ $out['outlet_nu'] }} - {{ $out['name'] }}</p>
                        @endif
                        @if ($out['is_deleted'] == 1)
                            <p>Menghapus outlet {{ $out['outlet_nu'] }} - {{ $out['name'] }}</p>
                        @endif
                    @endforeach
                </details>
            </div>
        @else
            <div class="w-1/2 p-3 mt-3 mb-3 bg-white rounded shadow-xl overflow-x-auto text-xs">
                {{ $log['action_type'] }} by <b>{{ $log['name'] }}</b> at {{ $log['created_at'] }}
            </div>
        @endif
    @endforeach
</div>
