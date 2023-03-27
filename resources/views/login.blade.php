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
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
</head>

<body class="bg-white font-family-karla h-screen">
    <div class="w-full flex flex-wrap">
        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">
            @if (session()->has('failure'))
                <div class="w-100 p-2 m-3 text-center bg-red-500 rounded-md shadow">{{ session('failure') }}</div>
            @endif
            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <a href="#" class="text-white font-bold text-xl p-4"><img src={{URL('/images/logo2.png')}} /></a>
            </div>
            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Welcome.</p>
                <form class="flex flex-col pt-3 md:pt-8" method="POST" action="/login">
                    @csrf
                    <div class="flex flex-col pt-4">
                        <label for="username" class="text-lg">User</label>
                        <input type="text" id="username" name="username" placeholder="3000"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @error('username')
                        <div class="w-full p-2 bg-red-500 rounded-md shadow">{{ $message }}</div>
                    @enderror
                    <div class="flex flex-col pt-4">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @error('password')
                        <div class="w-full p-2 bg-red-500 rounded-md shadow">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Log In"
                        class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                </form>
            </div>
        </div>
        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/6dW3xyQvcYE">
        </div>
    </div>
</body>

</html>
