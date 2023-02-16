<div class="p-5 bg-white rounded shadow-xl overflow-x-auto">
    <div class="mb-3">
        <a class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" href="/users/create">Create</a>
    </div>
    <div class="">
        <input wire:model="search" type="text" placeholder="Search by email, username or email"
            class="shadow w-1/2 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
    </div>
    <table class="min-w-max w-full table-auto mt-3">
        <thead>
            <tr class="uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left" wire:click.sort="sortBy('name')">Name</th>
                {{-- <th class="py-3 px-6 text-left" wire:click.sort="sortBy('username')">Username</th> --}}
                {{-- <th class="py-3 px-6 text-left" wire:click.sort="sortBy('email')">Email</th> --}}
                <th class="py-3 px-6 text-left">Role</th>
                <th class="py-3 px-6 text-left">Rep Man</th>

                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    {{-- <td class="px-4 py-2">{{ $user->username }}</td> --}}
                    {{-- <td class="px-4 py-2">{{ $user->email }}</td> --}}
                    <td class="px-4 py-2">{{ $user->role->name }}</td>
                    <td class="px-4 py-2">{{ $user->reportingManager ? $user->reportingManager->name: '' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="/users/{{ $user->id }}/update">
                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </a>
                            <form>
                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="border-t border-gray-400 text-center">
                    <td colspan="5">No users</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
