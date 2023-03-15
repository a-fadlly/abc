<div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
    <table class="min-w-max w-full table-auto mt-3">
        <thead>
            <tr class="uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">No.</th>
                <th class="py-3 px-6 text-left">ID MR</th>
                <th class="py-3 px-6 text-left">Nama MR</th>
                <th class="py-3 px-6 text-left">ID MD</th>
                <th class="py-3 px-6 text-left">Nama MD</th>
                <th class="py-3 px-6 text-left">Status</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($lampirans as $lampiran)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">
                        <a href="/lampiran/requisition/{{ $lampiran->lampiran_nu }}">{{ $lampiran->lampiran_nu }}</a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/lampiran/requisition/{{ $lampiran->lampiran_nu }}">{{ $lampiran->user->username }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/lampiran/requisition/{{ $lampiran->lampiran_nu }}">{{ $lampiran->user->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/lampiran/requisition/{{ $lampiran->lampiran_nu }}">{{ $lampiran->doctor->doctor_nu }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <a href="/lampiran/requisition/{{ $lampiran->lampiran_nu }}">{{ $lampiran->doctor->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        <span
                            class="px-2 py-1 font-semibold leading-tight {{ $lampiran->status == 4 ? 'text-green-700' : 'text-orange-700' }} {{ $lampiran->status == 4 ? 'bg-green-100' : 'bg-orange-100' }} rounded-full dark:text-white {{ $lampiran->status == 4 ? 'dark:bg-green-600' : 'dark:bg-orange-600' }}">
                            @switch($lampiran->status)
                                @case(1)
                                    Pending
                                @break

                                @case(2)
                                    In Progress
                                @break

                                @case(3)
                                    Rejected
                                @break

                                @case(4)
                                    Done
                                @break

                                @case(5)
                                    Rejected
                                @break

                                @default
                            @endswitch
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
