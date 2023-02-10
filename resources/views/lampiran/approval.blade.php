@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <div class="flex items-center justify-center">
            <div class="w-full lg:w-5/6 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Approval
                </p>
                <div class="leading-loose">
                    <livewire:lampiran-approval />
                </div>
            </div>
        </div>
    </div>
@endsection