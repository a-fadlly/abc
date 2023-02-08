@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
                <a href="/lampiran/create">
                    <div
                        class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Create Lampiran</p>
                            <p class="text-sm text-gray-600">Buat lampiran baru</p>
                        </div>
                    </div>
                </a>
                <a href="/lampiran/in_progress">
                    <div
                        class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Lampiran in progress</p>
                            <p class="text-sm text-gray-600">Lihat lampiran yang sedang berjalan</p>
                        </div>
                    </div>
                </a>
                <a href="/lampiran/history">
                    <div
                        class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">History lampiran</p>
                            <p class="text-sm text-gray-600">Lihat lampiran sebelumnya</p>
                        </div>
                    </div>
                </a>
            </div>
        </main>
    </div>
@endsection
