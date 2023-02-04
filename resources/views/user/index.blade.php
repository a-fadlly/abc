@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            @if (session()->has('failure'))
                <div class="w-100 p-2 m-3 text-center bg-red-500 rounded-md shadow">{{ session('failure') }}</div>
            @endif
            <div class="w-full mt-6">
                <div>
                    <a href="/users/create">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3">
                            Create New
                        </button>
                    </a>
                </div>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Username</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                <th class="text-left py-3 px-4 text-center uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-left py-3 px-4">{{ $user->username }}</td>
                                    <td class="text-left py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a class="mr-1" href="/users/{{ $user->id }}/update">
                                                <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110"><i
                                                        class="fa fa-edit"></i></button>
                                            </a>
                                            <form action="/users/delete" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" id="id" name="id"
                                                    value="{{ $user->id }}">
                                                <button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center py-3 px-4" colspan="5">There are no users.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {!! $users->withQueryString()->links() !!}
                </div>
            </div>
        </main>
    </div>
@endsection
