<div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
    <table class="min-w-max w-full table-auto mt-3">
        <thead>
            <tr class="uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">No.</th>
                <th class="py-3 px-6 text-left">Nama MR</th>
                <th class="py-3 px-6 text-left">Nama MD</th>
                <th class="py-3 px-6 text-left">Regional</th>
                <th class="py-3 px-6 text-left">Dibuat Oleh</th>
                <th class="py-3 px-6 text-left">Status</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($lampirans as $lampiran)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">
                         <a href="/lampiran/approval/{{ $lampiran->lampiran_nu }}">{{ $lampiran->lampiran_nu }}</a>
                    </td>
                    <td class="px-4 py-2">
                         <a href="/lampiran/approval/{{ $lampiran->lampiran_nu }}">{{ $lampiran->user->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                         <a href="/lampiran/approval/{{ $lampiran->lampiran_nu }}">{{ $lampiran->doctor->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                         <a href="/lampiran/approval/{{ $lampiran->lampiran_nu }}">Region 5</a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/lampiran/approval/{{ $lampiran->lampiran_nu }}">{{ $lampiran->createdBy->name }}</a>
                    </td>
                    <td class="px-4 py-2">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                            Pending
                        </span>
                    </td>
                </tr>
            @empty
                <tr class="border-b border-gray-200 hover:bg-gray-100 text-center">
                    <td colspan="6">All good!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
