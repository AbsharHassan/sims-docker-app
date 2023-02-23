@extends('layout')

@section('content')

<div class="h-full md:grid md:grid-cols-[200px_minmax(200px,_1fr)] md:grid-rows-[75px_minmax(75px,_1fr)]">
    
@include('partials._sidebar')
@include('partials._header')

<div class="pb-[20px]">
    <x-card class=" bg-white p-10 rounded-lg max-w-lg mx-auto mt-24 shadow-2xl">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Create an Entry
            </h2>
            <p class="mb-4">Enter details of the student or go <a href="/" class="underline"> back </a></p>
        </header>
        <hr class="my-[20px]">
        <form method="POST" action="/students">
            @csrf
            <div class="mb-6">
                <label
                    for="name"
                    class="inline-block text-md mb-2"
                    >Student Name</label
                >
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="name" value=" {{ old('name') }}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="age" class="inline-block text-md mb-2"
                    >Student Age</label
                >
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="age" value=" {{ old('age') }}"
                />
                @error('age')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label
                    for="CGPA"
                    class="inline-block text-md mb-2"
                    >Student's Current CGPA</label
                >
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="CGPA" value=" {{ old('CGPA') }}"
                />
                @error('CGPA')
                    <p class="text-red-500 text-xs mt-1">
                        @php
                            echo str_replace('c g p a', 'CGPA', $message);
                        @endphp
                    </p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="SGPA" class="inline-block text-md mb-2"
                    >Student's Latest SGPA</label
                >
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="SGPA" value=" {{ old('SGPA') }}"
                />
                @error('SGPA')
                    <p class="text-red-500 text-xs mt-1">
                        @php
                        echo str_replace('s g p a', 'SGPA', $message);
                        @endphp
                    </p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label
                    for="FSC"
                    class="inline-block text-md mb-2"
                >
                    Student's FSC %
                </label>
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="FSC" placeholder="Please enter the value without the % sign" value=" {{ old('FSC') }}"
                />
                @error('FSC')
                    <p class="text-red-500 text-xs mt-1">
                        @php
                        echo str_replace('f s c', 'FSC %', $message);
                        @endphp
                    </p>
                @enderror
            </div>
    
            <div class="mb-6">
                <label for="Matric" class="inline-block text-md mb-2">
                    Student's Matric %
                </label>
                <input
                    type="text"
                    class="bg-gray-200 border border-gray-200 rounded p-2 w-full"
                    name="Matric"
                    placeholder="Please enter the value without the % sign" value=" {{ old('Matric') }}"
                />
                @error('Matric')
                    <p class="text-red-500 text-xs mt-1">
                        <p class="text-red-500 text-xs mt-1">
                            @php
                            echo str_replace('matric', 'Matric %', $message);
                            @endphp
                        </p>
                    </p>
                @enderror
            </div>
    
            <div class="mt-[50px] flex justify-between items-center">
                <x-card class="m-0 p-1 px-2 rounded-md bg-sky-900 text-white text-xs hover:bg-black">
                    <button
                        class="bg-laravel text-white rounded py-2 px-4 "
                    >
                        Create Entry
                    </button>
                </x-card>
                <a href="/" class="text-black"> Back </a>
            </div>
            
        </form>
    </x-card>    
</div>

@endsection