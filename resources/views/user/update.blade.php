@extends('layouts.app')

@section('content')
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <div class="flex items-center justify-center">
            <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                <p class="text-xl pb-6 flex items-center">
                    <i class="fas fa-list mr-3"></i> Update User
                </p>
                <div class="leading-loose">
                    <livewire:update-user :user_id="$user_id" />
                </div>
            </div>
        </div>
    </div>
@endsection
