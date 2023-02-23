@extends('layout')

@section('content')

<div class="h-full md:grid md:grid-cols-[200px_minmax(200px,_1fr)] md:grid-rows-[75px_minmax(75px,_1fr)]">

@include('partials._sidebar')
@include('partials._header')
{{-- MAIN CONTENT --}}

    <section>
        <x-card>
            <div class="flex justify-between items-center text-slate-600 text-lg font-bold my-5">
                <div class="p-1">Click on ID to view full details</div>
                <div>
                    <x-card class="m-0 p-1 px-2 rounded-md bg-sky-900 text-white text-xs">
                        <a href="/students/create">
                            Create New Entry</a>
                    </x-card>
                </div>
            </div>
            <div>
                @if(count($students)==0)
                <div class="text-2xl">
                    <p class="inline p-3 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">No student information found :/</p>
                    
                    <p class="mt-3"><a class="underline" href="/">Return</a>?</p>
                </div>
                @endif
            </div>
            <div>
                @foreach ($students as $student)
                    <x-student-card :student="$student" />
                @endforeach
            </div>
        </x-card>
    </section>
</div>

@endsection




{{-- @foreach($students as $student)
    <h2><a href="/students/{{ $student['id'] }}">{{ $student['name'] .' : '. $student['age'] . ' years old' }}</a></h2>
    <p>{{ 'CGPA: ' . $student['CGPA'] . ' SGPA: ' . $student['SGPA'] . ' FSC: ' . $student['FSC'] . ' Matric: ' . $student['Matric'] }}</p>
@endforeach --}}