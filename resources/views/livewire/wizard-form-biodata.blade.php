<div class="p-10 bg-white rounded shadow-xl">
    <div class="flex justify-between">
        <span class="text-xs text-gray-600">Step {{ $step }} of 7</span>
        <div class="flex">
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 1) font-weight: bold; @endif">1. Pribadi</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 2) font-weight: bold; @endif">2. Keluarga</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 3) font-weight: bold; @endif">3. Pendidikan</span>
            <span class="text-xs text-gray-600 mr-3"
                style="cursor:pointer; @if ($step === 4) font-weight: bold; @endif">4. Praktek</span>
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
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Nama
                lengkap</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                name="name" placeholder="Dr. Lisa Su" wire:model="name" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="specialty">Spesialisasi</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="specialty"
                name="specialty" placeholder="Psikiatri" wire:model="specialty" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="status">Status</label>
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="status" name="status"
                wire:model="status">
                <option value="Negeri">Negeri</option>
                <option value="Swasta">Swasta</option>
            </select>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="gender">Jenis
                kelamin</label>
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="gender" name="gender"
                wire:model="gender">
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
            <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="marital_status" name="marital_status"
                wire:model="religion">
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
        <div class="mt-4">
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 2)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="spouse">Nama
                pasangan</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="spouse"
                name="spouse" placeholder="Daniel Lin" wire:model="spouse" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama anak</label>
            <div class="justify-center flex">
                <input id="name" type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Nama" />
                <input id="age" type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Umur" />
                <input id="education" type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Pendidikan" />
            </div>
            <div class="mt-3">
                <button class="mb-5">
                    <span style="color: Mediumslateblue;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                    </span>
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-2">Name</th>
                        <th scope="col" class="px-4 py-2">Age</th>
                        <th scope="col" class="px-4 py-2">Education</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Ahsan</td>
                        <td class="px-4 py-2">9</td>
                        <td class="px-4 py-2">SD</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
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
                    placeholder="Psikiatri UI" />
                <input id="grad_year" type="number" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="2001" />
            </div>
            <div class="mt-3">
                <button class="mb-5">
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
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="col" class="px-4 py-2">1</th>
                        <td class="px-4 py-2">FK UNAIR</td>
                        <td class="px-4 py-2">2010</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
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
                praktek</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="workplace"
                name="workplace" placeholder="Pelni Hospital" wire:model="workplace" />
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="work_address">Alamat
                praktek</label>
            <textarea type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="work_address"
                name="work_address" placeholder="Jl. K.S. Tubun No.92 - 94"  wire:model="work_address"></textarea>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="work_phone">Telp
                prektek</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="work_phone"
                name="work_phone" placeholder="021-12345678"  wire:model="work_phone"/>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="fax">Fax</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="fax"
                name="fax" placeholder="031-87654321"  wire:model="fax"/>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="patients_per_day">Pasien
                per hari</label>
            <input type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="patients_per_day"
                name="patients_per_day" placeholder="15"  wire:model="patients_per_day"/>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-6 py-2 text-sm rounded-lg outline-none bg-gray-300 hover:bg-gray-400"
                wire:click="previousStep">Previous</button>
            <button
                class="px-6 py-2 text-sm text-white bg-indigo-500 rounded-lg outline-none hover:bg-indigo-600 ring-indigo-300"
                wire:click="nextStep">Next</button>
        </div>
    @elseif ($step === 5)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Produk</label>
            <div class="justify-center flex">
                <input id="prod_name" name="prod_name" type="text"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" placeholder="BAMGETOL" />
                <input id="quantity" name="quantity" type="number"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" placeholder="3" />
            </div>
            <div class="mt-3">
                <button class="mb-5">
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
                        <th scope="col" class="px-4 py-2">Qty</th>
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">TAKELIN 500 TAB</td>
                        <td class="px-4 py-2">5</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">TAKELIN 500INJ</td>
                        <td class="px-4 py-2">5</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Produk kompetitor</label>
            <div class="justify-center flex">
                <input id="competitor_product" type="text"
                    class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2" placeholder="XANAX" />
            </div>
            <div class="mt-3">
                <button class="mb-5">
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
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">LANKOLIN</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">LEVOPAR</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
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
    @elseif ($step === 6)
        <div class="mt-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Outlets</label>
            <div class="justify-center flex">
                <input id="outlet" type="text" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded mr-2"
                    placeholder="Medistra Hospital" />
            </div>
            <div class="mt-3">
                <button class="mb-5">
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
                        <th scope="col" class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">RS AL IRSYAD</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">2</td>
                        <td class="px-4 py-2">APT IBUNDA</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-4 py-2">3</td>
                        <td class="px-4 py-2">APT KEMAJUAN</td>
                        <td class="px-4 py-2">
                            <button
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remove</button>
                        </td>
                    </tr>
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
                placeholder="..."  wire:model="notes"></textarea>
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
