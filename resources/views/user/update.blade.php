@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <div class="flex items-center justify-center">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Update User
                </p>
                <div class="leading-loose">
                    <form class="p-10 bg-white rounded shadow-xl" method="POST" action="/users/create">
                        @csrf
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="name">Name</label>
                            <input value="{{ $user->name }}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                                id="name" name="name" type="text" placeholder="Name" aria-label="Name">
                        </div>
                        @error('name')
                            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="username">Username</label>
                            <input value="{{ $user->username }}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                                id="username" name="username" type="text" placeholder="Username" aria-label="Username">
                        </div>
                        @error('username')
                            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="email">Email</label>
                            <input value="{{ $user->email }}" class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded"
                                id="email" name="email" type="text" placeholder="Your Email" aria-label="Email">
                        </div>
                        @error('email')
                            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="password">Password</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password"
                                type="password" placeholder="password" aria-label="password">
                        </div>
                        @error('password')
                            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
                        @enderror
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
