<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwindcss</title>
    <meta name="author" content="">
    <meta name="description" content="">
    <!-- Tailwind -->
    @vite('resources/css/app.css')
    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="/" class="text-white text-3xl font-semibold hover:text-gray-300"><img
                    src={{ URL('/images/logo.png') }} /></a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/"
                class="flex items-center {{ request()->is('/') ? 'active-nav-link' : '' }} text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            <a href="/users"
                class="flex items-center {{ request()->is('users') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fa fa-users mr-3"></i>
                Users
            </a>

            <a href="/lampiran"
                class="flex items-center {{ request()->is('lampiran') ? 'active-nav-link' : '' }} text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fa fa-check-square mr-3"></i>
                Lampiran
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute z-10 w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <button
                        class="block px-4 py-2 account-link hover:text-white w-full text-left">{{ Auth::user()->name }}</button>
                    <form action="/logout" method="POST" class="d-inline">
                        @csrf
                        <button class="block px-4 py-2 account-link hover:text-white w-full text-left">Sign Out</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>
            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex' : 'hidden'" class="flex flex-col pt-4">
                <a href="/" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">Home</a>
                <a href="/users" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">Users</a>
                <a href="/lampiran" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">Lampiran</a>
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button
                        class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item w-full text-left">
                        Sign Out
                    </button>
                </form>
            </nav>
        </header>
        @yield('content')
    </div>
    @livewireScripts
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

</html>
