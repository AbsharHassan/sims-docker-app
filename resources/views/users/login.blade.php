@extends('layout')

@section('content')

<header class="max-w-lg mx-auto px-2 md:px-0">
    <a href="#">
        <h1 class="text-3xl text-center mx-auto mt-10 pb-1 md:text-3xl font-bold">Student Information Management System</h1>
    </a>
</header>

<div class="mt-[30px] max-w-lg mx-auto p-3 my-10 md:p-0">
    <div class="bg-white rounded-lg shadow-2xl p-8 md:p-12">
        <section>
            <h3 class="font-bold text-2xl">Welcome to the Login Page</h3>
            <p class="text-gray-600 pt-5">Sign into your account.</p>
        </section>
        <section class="mt-8">
            <form class="flex flex-col" method="POST" action="users/authenticate">
                @csrf
                <div class="mb-1 mt-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-300 transition duration-500 " type="email" id="email" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="text-red-500 text-xs">
                        {{ $message }}
                    </p>
                @enderror
                <div class="mb-1 mt-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-300 transition duration-500" type="password" id="password" name="password" value="{{ old('password') }}">
                </div>
                @error('password')
                    <p class="text-red-500 text-xs">
                        {{ $message }}
                    </p>
                @enderror
                <div class="flex justify-end">
                    <a href="#" class="text-sm text-sky-600 hover:text-sky-700 hover:underline mb-6">Forgot your password?</a>
                </div>
                <button class="bg-sky-600 text-center py-3 rounded-lg text-white font-bold hover:bg-sky-700 transition duration-200 shadow-lg hover:shadow-xl" type="submit">Sign In</button>
            </form>
        </section>
    </div>    
</div>
<section>
    <div class="max-w-lg mx-auto text-center mt-[-8px] mb-6">
        <p class="text-sky-800">Don't have an account? <a href="/register" class="font-bold hover:underline">Sign up here</a>.</p>
    </div>
</section>
<footer class="max-w-lg mx-auto flex justify-center text-sky-800">
    <a href="#" class="hover:underline">Contact</a>
    <span class="mx-2 font-bold">•</span>
    <p class="hover:text-sky-900">Designed and Programmed by Abshar Hassan</p>
</footer>

@endsection