<div class="p-10 bg-white rounded shadow-xl">
    <div class="flex justify-between">
        <span class="text-xs text-gray-600">Step {{ $step }} of 7</span>
        <div class="flex">
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 1) font-weight: bold; @endif">1. User</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 2) font-weight: bold; @endif">2. Personal</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 3) font-weight: bold; @endif">3. Pendidikan</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 4) font-weight: bold; @endif">4. Praktik</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 5) font-weight: bold; @endif">5. Produk</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 6) font-weight: bold; @endif">6. Outlet</span>
            <span class="text-xs text-gray-600"
                style="cursor:pointer; @if ($step === 7) font-weight: bold; @endif">7. Catatan</span>
        </div>
    </div>
    @if ($step === 1)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="user_name">Yang
                Mengajukan</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="user_name"
                name="user_name" placeholder="Yang mengajukan" wire:model="user_name" />
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded absolute z-10">
                <ul class="rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->id }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->username }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-4">
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 2)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Nama
                lengkap</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                name="name" placeholder="Dr. Lisa Su" wire:model="name" />
        </div>
        <div class="error">
            @error('name')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="specialty">Spesialisasi</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="specialty"
                name="specialty" placeholder="Psikiatri" wire:model="specialty" />
        </div>
        <div class="error">
            @error('specialty')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="status">Status</label>
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="status" name="status"
                wire:model="status">
                <option value="">Choose status</option>
                <option value="Negeri">Negeri</option>
                <option value="Swasta">Swasta</option>
            </select>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="gender">Jenis
                kelamin</label>
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="gender" name="gender"
                wire:model="gender">
                <option value="">Choose gender</option>
                <option value="Male">Laki-laki</option>
                <option value="Female">Perempuan</option>
            </select>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birthplace">Tempat
                lahir</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="birthplace"
                name="birthplace" placeholder="Bandung" wire:model="birthplace" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birthdate">Tanggal
                lahir</label>
            <input type="date" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="birthdate"
                name="birthdate" placeholder="01/01/1980" wire:model="birthdate" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="religion">Agama</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="religion"
                name="religion" placeholder="Islam" wire:model="religion" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="marital_status">Status
                pernikahan</label>
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="marital_status"
                name="marital_status" wire:model="marital_status">
                <option value="">Choose marital status</option>
                <option value="Married">Menikah</option>
                <option value="Single">Belum menikah</option>
            </select>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="hobby">Hobi</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="hobby"
                name="hobby" placeholder="Gaming" wire:model="hobby" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">Tempat
                tinggal</label>
            <textarea type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="address" name="address"
                placeholder="Jalan Raya Pelabuhan Km. 18, Cikembar Sukabumi - Jawa Barat" wire:model="address"></textarea>
        </div>
        <div class="error">
            @error('address')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="phone">Telp</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="phone"
                name="phone" placeholder="021-8601234" wire:model="phone">
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="mobile_phone">Telp
                seluler</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="mobile_phone"
                name="mobile_phone" placeholder="08123456789" wire:model="mobile_phone" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="spouse">Nama
                pasangan</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="spouse"
                name="spouse" placeholder="Daniel Lin" wire:model="spouse" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Anak</label>
            <div class="justify-center flex">
                <input id="child_name" type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Nama" wire:model="child_name" />
                <input id="age" type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Umur" wire:model="child_age" />
                <input id="child_education" type="text"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" placeholder="Pendidikan"
                    wire:model="child_education" />
            </div>
            <div class="mt-3">
                <button class="mb-5"
                    wire:click.debounce.500ms="addChild('{{ $child_name }}', '{{ $child_age }}', '{{ $child_education }}')">
                    <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    </span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">No</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Age</th>
                        <th scope="col" class="px-4 py-2">Education</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num = 1; @endphp
                    @foreach ($childs as $index => $child)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $num++ }}</td>
                            <td class="px-4 py-2">{{ $child['child_name'] }}</td>
                            <td class="px-4 py-2">{{ $child['child_age'] }}</td>
                            <td class="px-4 py-2">{{ $child['child_education'] }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="removeChild({{ $index }});"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
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
    @elseif ($step === 3)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Pendidikan
                terakhir</label>
            <div class="justify-center flex">
                <input id="education" type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Psikiatri UI" wire:model="edu" />
                <input id="grad_year" type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="2001" wire:model="grad_year" />
            </div>
            <div class="mt-3">
                <button class="mb-5"
                    wire:click.debounce.500ms="addEducation('{{ $edu }}', '{{ $grad_year }}')">
                    <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    </span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">No</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Year</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num = 1; @endphp
                    @foreach ($educations as $index => $education)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="col" class="px-4 py-2">{{ $num++ }}</th>
                            <td class="px-4 py-2">{{ $education['edu'] }}</td>
                            <td class="px-4 py-2">{{ $education['grad_year'] }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="removeEducation({{ $index }});"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
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
    @elseif ($step === 4)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="workplace">Tempat
                praktik</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="workplace"
                name="workplace" placeholder="Pelni Hospital" wire:model="workplace" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="work_address">Alamat
                praktik</label>
            <textarea type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="work_address"
                name="work_address" placeholder="Jl. K.S. Tubun No.92 - 94" wire:model="work_address"></textarea>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="work_phone">Telp
                prektek</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="work_phone"
                name="work_phone" placeholder="021-12345678" wire:model="work_phone" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="fax">Fax</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="fax"
                name="fax" placeholder="031-87654321" wire:model="fax" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="patients_per_day">Pasien
                per hari</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="patients_per_day"
                name="patients_per_day" placeholder="15" wire:model="patients_per_day" />
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 5)
        <div class="error">
            @error('products')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="error">
            @error('product_nu')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="error">
            @error('product_name')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="error">
            @error('product_quantity')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="product_name">Produk</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="product_name"
                name="product_name" placeholder="Type something..." wire:model="product_name" />
            <div wire:loading wire:target="search">Loading...</div>
            <div wire:loading.remove wire:target="search" class="bg-white rounded absolute z-10">
                <ul class="rounded-lg shadow-lg overflow-auto max-h-64">
                    @foreach ($suggestions as $suggestion)
                        <li wire:click="setValues('{{ $suggestion->product_nu }}'); $set('suggestions', [])"
                            class="p-2 hover:bg-gray-200 cursor-pointer">
                            {{ $suggestion->product_nu }} - {{ $suggestion->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="product_quantity">Quantity</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="product_quantity"
                name="product_quantity" placeholder="5" wire:model="product_quantity" />
        </div>
        <div class="mt-3">
            <button class="mb-5"
                wire:click.debounce.500ms="addProduct('{{ $product_nu }}', '{{ $product_quantity }}')">
                <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</span>
            </button>
        </div>
        <div class="">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-2">No</th>
                            <th scope="col" class="px-4 py-2">Product Number</th>
                            <th scope="col" class="px-4 py-2">Name</th>
                            <th scope="col" class="px-4 py-2">Qty</th>
                            <th scope="col" class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num = 1; @endphp
                        @foreach ($products as $index => $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $num++ }}</td>
                                <td class="px-4 py-2">{{ $product['product_nu'] }}</td>
                                <td class="px-4 py-2">{{ $product['product_name'] }}</td>
                                <td class="px-4 py-2">{{ $product['product_quantity'] }}</td>
                                <td class="px-4 py-2">
                                    <button wire:click="removeProduct({{ $index }});"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Produk kompetitor</label>
            <div class="justify-center flex">
                <input id="competitor_product_name" type="text"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" placeholder="XANAX"
                    wire:model="competitor_product_name" />
            </div>
            <div class="mt-3">
                <button class="mb-5"
                    wire:click.debounce.500ms="addCompetitorProduct('{{ $competitor_product_name }}')">
                    <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    </span>
                </button>
            </div>
        </div>
        <div class="">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-2">No</th>
                            <th scope="col" class="px-4 py-2">Name</th>
                            <th scope="col" class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num = 1; @endphp
                        @foreach ($competitor_products as $index => $competitor_product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-2">{{ $num++ }}</td>
                                <td class="px-4 py-2">{{ $competitor_product['product_name'] }}</td>
                                <td class="px-4 py-2">
                                    <button wire:click="removeCompetitorProduct({{ $index }});"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 6)
        <div class="error">
            @error('outlets')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="error">
            @error('outlet_nu')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="error">
            @error('outlet_name')
                <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Outlets</label>
            <div class="justify-center flex">
                <input id="outlet_name" type="text"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" wire:model="outlet_name"
                    placeholder="Medistra Hospital" />
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
            </div>
            <div class="mt-3">
                <button class="mb-5" wire:click.debounce.500ms="addOutlet('{{ $outlet_nu }}')">
                    <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    </span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">No</th>
                        <th scope="col" class="px-4 py-2">Outlet Number</th>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Address</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $num = 1; @endphp
                    @foreach ($outlets as $index => $outlet)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $num++ }}</td>
                            <td class="px-4 py-2">{{ $outlet['outlet_nu'] }}</td>
                            <td class="px-4 py-2">{{ $outlet['outlet_name'] }}</td>
                            <td class="px-4 py-2">{{ $outlet['outlet_address'] }}</td>
                            <td class="px-4 py-2">
                                <button wire:click="removeOutlet({{ $index }});"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
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
    @elseif ($step === 7)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="notes">Keterangan
                tambahan</label>
            <textarea type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="notes" name="notes"
                placeholder="..." wire:model="notes"></textarea>
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
