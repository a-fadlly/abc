<div>
    <div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
        <div class="px-4 sm:px-6 text-center mb-5">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Applicant Information</h3>
            <p class="mt-1 text-sm text-gray-500">Personal details and application.</p>
        </div>
        <div class="">
            @php
                $additional_details = json_decode($biodata->additional_details, true);
            @endphp
            <dl>
                <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">: {{ $biodata['name'] }}
                    </dd>
                </div>
                @if (array_key_exists('specialty', $additional_details))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Spesialisasi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['specialty'] }}
                        </dd>
                    </div>
                @endif
                @if (array_key_exists('status', $additional_details) && !is_null($additional_details['status']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['status'] }}
                        </dd>
                    </div>
                @endif
                @if (array_key_exists('gender', $additional_details) && !is_null($additional_details['gender']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['gender'] }}
                    </div>
                @endif
                @if (array_key_exists('birthplace', $additional_details) && !is_null($additional_details['birthplace']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['birthplace'] }}
                    </div>
                @endif
                @if (array_key_exists('birthdate', $additional_details) && !is_null($additional_details['birthdate']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['birthdate'] }}
                    </div>
                @endif
                @if (array_key_exists('religion', $additional_details) && !is_null($additional_details['religion']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Agama</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['religion'] }}
                    </div>
                @endif
                @if (array_key_exists('marital_status', $additional_details) && !is_null($additional_details['marital_status']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Status Pernikahan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['marital_status'] }}
                    </div>
                @endif
                @if (array_key_exists('hobby', $additional_details) && !is_null($additional_details['hobby']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Hobi</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['hobby'] }}
                    </div>
                @endif
                <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        : {{ $biodata['address'] }}</dd>
                </div>
                @if (array_key_exists('phone', $additional_details) && !is_null($additional_details['phone']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['phone'] }}
                    </div>
                @endif
                @if (array_key_exists('mobile_phone', $additional_details) && !is_null($additional_details['mobile_phone']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Mobile Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['mobile_phone'] }}
                    </div>
                @endif

                @if (array_key_exists('spouse', $additional_details) && !is_null($additional_details['spouse']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama Pasangan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['spouse'] }}</dd>
                    </div>
                @endif
                @if (array_key_exists('childs', $additional_details) && count($additional_details['childs']) > 0)
                    {{-- anak --}}
                    <div class="">
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Anak ↓</dt>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th class="py-3 px-6 text-left">Nama</th>
                                    <th class="py-3 px-6 text-left">Umur</th>
                                    <th class="py-3 px-6 text-left">Pendidikan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($additional_details['childs'] as $child)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-1 px-6">{{ $child['child_name'] }}</td>
                                        <td class="py-1 px-6">{{ $child['child_age'] }}</td>
                                        <td class="py-1 px-6">{{ $child['child_education'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (array_key_exists('educations', $additional_details) && count($additional_details['educations']) > 0)
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 mt-6">
                        <dt class="text-sm font-medium text-gray-500">Pendidikan Terakhir</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md">
                                @foreach ($additional_details['educations'] as $education)
                                    <li class="flex items-center justify-between py-1 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <span class="ml-2 w-0 flex-1 truncate">{{ $education['edu'] }}
                                                ({{ $education['grad_year'] }})
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                @endif
                @if (array_key_exists('workplace', $additional_details) && !is_null($additional_details['workplace']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tempat Praktik</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['workplace'] }}
                    </div>
                @endif
                @if (array_key_exists('work_address', $additional_details) && !is_null($additional_details['work_address']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['work_address'] }}
                    </div>
                @endif
                @if (array_key_exists('work_phone', $additional_details) && !is_null($additional_details['work_phone']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Work phone</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['work_phone'] }}
                    </div>
                @endif
                @if (array_key_exists('fax', $additional_details) && !is_null($additional_details['fax']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Fax</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['fax'] }}
                    </div>
                @endif
                @if (array_key_exists('patients_per_day', $additional_details) && !is_null($additional_details['patients_per_day']))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Pasien per Hari</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['patients_per_day'] }}
                    </div>
                @endif
                @if (array_key_exists('products', $additional_details) && count($additional_details['products']) > 0)
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Produk ↓</dt>
                    </div>
                    <div class="">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th class="py-3 px-6 text-left">Product Nu</th>
                                    <th class="py-3 px-6 text-left">Nama</th>
                                    <th class="py-3 px-6 text-left">Quantity (r/bln)</th>
                                    <th class="py-3 px-6 text-left">Price</th>
                                    <th class="py-3 px-6 text-left">Value</th>
                                    <th class="py-3 px-6 text-left">%</th>
                                    <th class="py-3 px-6 text-left">Value Cicilan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($additional_details['products'] as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-1 px-6">{{ $product['product_nu'] }}</td>
                                        <td class="py-1 px-6">{{ $product['product_name'] }}</td>
                                        <td class="py-1 px-6">{{ $product['product_quantity'] }}</td>
                                        <td class="py-1 px-6">Price placeholder</td>
                                        <td class="py-1 px-6">Value placeholder</td>
                                        <td class="py-1 px-6">{{ $product['product_percent'] }}</td>
                                        <td class="py-1 px-6">Value Cicilan placeholder</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (array_key_exists('competitor_products', $additional_details) &&
                        count($additional_details['competitor_products']) > 0)
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 mt-6">
                        <dt class="text-sm font-medium text-gray-500">Produk Kompetitor</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <tbody>
                                    @foreach ($additional_details['competitor_products'] as $competitor_product)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-1 px-6">
                                                {{ $competitor_product['product_name'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </dd>
                    </div>
                @endif
                @if (array_key_exists('outlets', $additional_details) && count($additional_details['outlets']) > 0)
                    <div class="">
                        <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 mt-6">
                            <dt class="text-sm font-medium text-gray-500">Outlet ↓</dt>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                <tr>
                                    <th class="py-3 px-6 text-left">Outlet Nu</th>
                                    <th class="py-3 px-6 text-left">Name</th>
                                    <th class="py-3 px-6 text-left">Address</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($additional_details['outlets'] as $outlet)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-1 px-6">{{ $outlet['outlet_nu'] }}</td>
                                        <td class="py-1 px-6">{{ $outlet['outlet_name'] }}</td>
                                        <td class="py-1 px-6">{{ $outlet['outlet_address'] }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @if (array_key_exists('notes', $additional_details))
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            : {{ $additional_details['notes'] }}</dd>
                    </div>
                @endif
            </dl>
        </div>
        @if ($button_visible)
            <div class="p-5">
                <form>
                    @if (Auth::user()->role == 'FIN')
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="comment">
                                Comment
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="comment" name="comment" rows="3" placeholder="Enter your comment"></textarea>
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none text-sm"
                            type="button" wire:click="approve();">
                            Approve
                        </button>
                        <button
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-sm"
                            type="button" wire:click="reject();">
                            Reject
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>
