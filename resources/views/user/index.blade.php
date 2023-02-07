@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <livewire:user-table />
            </div>
        </main>
    </div>
@endsection
