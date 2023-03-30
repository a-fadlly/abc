@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
                <a href="/biodata/create">
                    <div
                        class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Form Biodata</p>
                            <p class="text-sm text-gray-600">Buat ajuan baru</p>
                        </div>
                    </div>
                </a>
            </div>
        </main>
    </div>
@endsection
