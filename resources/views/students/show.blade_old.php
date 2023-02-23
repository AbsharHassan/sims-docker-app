@extends('layout')

@section('content')

<div class="h-full md:grid md:grid-cols-[200px_minmax(200px,_1fr)] md:grid-rows-[75px_minmax(75px,_1fr)]">

@include('partials._sidebar')
@include('partials._header')
{{-- MAIN CONTENT --}}
    
    <section>
        <x-card>
            <div class="bg-white space-y-3 p-4 rounded-lg shadow-md">
                <div class="sm:flex sm:justify-between sm:items-center text-sm sm:space-x-2 space-y-4 sm:space-y-0">
                    <div>
                        <a href="#" class="text-blue-500 font-bold text-sm hover:underline">{{ 'ID: ' . $student->id }}</a>
                    </div>
                    <div>
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'Name: ' . $student->name }}</span>
                    </div>
                    <div>
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'Age:' . $student->age }}</span>
                    </div>
                    <div>
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'CGPA: ' . $student->CGPA }}</span>
                    </div>
                    <div class="hidden lg:block">
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'SGPA: ' . $student->SGPA }}</span>
                    </div>
                    <div class="hidden xl:block">
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'FSC: ' . $student->FSC }}</span>
                    </div>
                    <div class="hidden xl:block">
                        <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-lg bg-opacity-50">{{ 'Matric: ' . $student->Matric }}</span>
                    </div>
                </div>
            </div>
        </x-card>
    </section>
</div>

@endsection

<div class="p-5 sm:p-10">
    <div class="bg-white p-10 rounded-lg max-w-2xl sm:mx-auto shadow-2xl">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                {{ $student->name }}
            </h2>
            <p class="mb-4">Details of student with ID no <span class="text-blue-500 font-bold text-sm hover:underline">{{ $student->id }}</span> <br> <a href="/" class="underline"> Return </a></p>
        </header>
        <hr class="my-[20px]">
        <div>
            <div class="mb-6">
                <div class="text-lg" >Student Name</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->name }}
                </div>
            </div>
            <div class="mb-6">
                <div class="text-lg" >Student Age</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->age }}
                </div>
            </div>
            <div class="mb-6">
                <div class="text-lg" >Student's CGPA</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->CGPA }}
                </div>
            </div>
            <div class="mb-6">
                <div class="text-lg" >Student's SGPA</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->SGPA }}
                </div>
            </div>
            <div class="mb-6">
                <div class="text-lg" >Student's FSC</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->FSC }}
                </div>
            </div>
            <div class="mb-6">
                <div class="text-lg" >Student's Matric</div>
                <div class="mt-2 bg-gray-200 border border-gray-200 rounded p-2 w-full">
                    {{ $student->Matric }}
                </div>
            </div>
    
            <div class="mt-[50px] flex justify-between items-center">
                <x-card class="m-0 p-1 px-2 rounded-md bg-sky-900 text-white text-xs hover:bg-black">
                    <button
                        class="bg-laravel text-white rounded py-2 px-4 "
                    >
                        Edit Entry
                    </button>
                </x-card>
                <a href="/" class="text-black"> Back </a>
            </div>
        </div>
    </div>    
</div>