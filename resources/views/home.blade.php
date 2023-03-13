@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Dashboard</h1>
            <div class="flex flex-wrap mt-6">
                <main class="w-full flex-grow p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4 w-full">
                        <div
                            class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                            <div class="px-3 py-2 rounded bg-yellow-600">
                                <i class="fa fa-users fa-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="font-semibold"><span class="num-2">{{ $countMembawahi }}</span> DM dan MR</h1>
                                <p class="text-xs"><span class="num-2"></span> active</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                            <div class="px-3 py-2 rounded bg-yellow-600">
                                <i class="fa fa-wallet fa-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="font-semibold"><span class="num-2">Total Sales</h1>
                                <p class="text-xs"><span class="num-2"></span> active</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center relative p-4 w-full bg-white rounded-lg overflow-hidden shadow hover:shadow-md">
                            <div class="px-3 py-2 rounded bg-yellow-600">
                                <i class="fa fa-pills fa-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="font-semibold"><span class="num-2">Products</h1>
                                <p class="text-xs"><span class="num-2"></span> active</p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </main>
    </div>
@endsection
