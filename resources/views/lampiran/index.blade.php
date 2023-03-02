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
                <a href="/lampiran/update">
                    <div
                        class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Update Lampiran</p>
                            <p class="text-sm text-gray-600">Ubah lampiran yang ada</p>
                        </div>
                    </div>
                </a>
                <a href="/lampiran/requisition">
                    <div
                        class="flex items-center relative inline-block p-4 w-full bg-white rounded-lg shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Approval lampiran</p>
                            <p class="text-sm text-gray-600">Approve atau reject lampiran</p>
                            @if ($countLampiranThatNeedToBeApproved > 0)
                                <span
                                    class="absolute top-0 left-0 px-2 py-0 translate-x-1/2 -translate-y-1/2 text-xs font-bold text-red-100 transform bg-red-600 rounded-[12px]">{{ $countLampiranThatNeedToBeApproved }}</span>
                            @endif
                        </div>
                    </div>
                </a>
                <a href="/lampiran/in_progress">
                    <div
                        class="flex items-center relative inline-block p-4 w-full bg-white rounded-lg shadow hover:shadow-md">
                        <div class="ml-3">
                            <p class="font-medium text-gray-800">Lampiran in progress
                            </p>
                            <p class="text-sm text-gray-600">Lihat lampiran yang sedang berjalan</p>
                            @if ($countLampiranInProgress > 0)
                                <span
                                    class="absolute top-0 left-0 px-2 py-0 translate-x-1/2 -translate-y-1/2 text-xs font-bold text-red-100 transform bg-red-600 rounded-[12px]">{{ $countLampiranInProgress }}</span>
                            @endif
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
