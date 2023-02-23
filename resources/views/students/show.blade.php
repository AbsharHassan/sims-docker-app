@extends('layout')

@section('content')

<div class="h-full md:grid md:grid-cols-[200px_minmax(200px,_1fr)] md:grid-rows-[75px_minmax(75px,_1fr)]">

@include('partials._sidebar')
@include('partials._header')
{{-- MAIN CONTENT --}}
    
    <section>
        <div class="p-5 sm:p-10">
            <div class="bg-white shadow-2xl rounded-lg p-6 ">
                <div class="md:flex md:flex-col rounded-lg max-w-5/6 sm:mx-auto shadow-2xl h-[1000px]">
              
                <div class="bg-gray-100 rounded mb-5 md:flex md:flex-row-reverse basis-2/6 p-6 ">
                    <div class="bg-white basis-1/4">
                    <img src="/images/pfp.jpg" alt=""></div>
                    <div class="basis-3/4">
                        <h3 class=" text-xl font-bold">Bio Data</h3>
                        <div class="grad3 w-[300px]"></div>
                        <div class="flex flex-row h-full">
                            <div class="basis-1/2 h-full">
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Name:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->first_name }} {{ $student->last_name }}</p></div>
                                </div>
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>DOB:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->dob }}</p></div>
                                </div>
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Joining:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->joining_date }}</p></div>
                                </div>
                            </div>
                            <div class="basis-1/2 h-full">
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Reg no:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->reg_no }}</p></div>
                                </div>
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Phone #</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->phone_number }}</p></div>
                                </div>
                                <br>
                                <div class="flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Father:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $family->father_name }}</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded mb-5 basis-1/6 p-6">
                    <div class="h-full">
                        <div>
                            <h3 class=" text-xl font-bold">Education History</h3>
                            <div class="grad3 w-[300px]"></div>
                        </div>
                        <div class="h-full flex flex-row mb-6">
                            <div class="h-full basis-1/2">
                                <div class="h-full items-center flex flex-row">
                                    <div class="w-[75px] font-bold"><p>FSC:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->FSC }}%</p></div>
                                </div>
                            </div>
                            <div class="h-full basis-1/2">
                                <div class="h-full items-center flex flex-row">
                                    <div class="w-[75px] font-bold"><p>Matric:</p></div>
                                    <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $student->Matric }}%</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded basis-5/6 flex flex-col">
                    <div class="md:flex md:flex-row p-6 h-full">
                        <div class="basis-2/3 h-4/5">
                            <div>
                                <h3 class=" text-xl font-bold">GPA Standing</h3>
                                <div class="grad3 w-[300px]"></div>
                            </div>
                            <div class="my-5 flex flex-row bg-white p-6 mr-10 rounded-xl w-9/10 h-[300px]">
                                <div class="basis-1/2">
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2"><p>Semester 1:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>{{ $academics[0]->sgpa }}</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2"><p>Semester 2:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>
                                            @if ($student->current_sem >= 2)
                                                {{ $academics[1]->sgpa }}
                                            @else
                                                ---
                                            @endif</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2"><p>Semester 3:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 3)
                                            {{ $academics[2]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2"><p>Semester 4:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 4)
                                            {{ $academics[3]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                </div>
                                <div class="basis-1/2">
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2"><p>Semester 5:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 5)
                                            {{ $academics[4]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2 mb-2"><p>Semester 6:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 6)
                                            {{ $academics[5]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2 mb-2"><p>Semester 7:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 7)
                                            {{ $academics[6]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                    <br>
                                    <div class="flex flex-row">
                                        <div class="w-[95px] font-bold mb-2 mb-2"><p>Semester 8:</p></div>
                                        <div class="mx-2 bg-gray-200 border border-gray-200 rounded w-full md:w-[200px] text-center"><p>@if ($student->current_sem >= 8)
                                            {{ $academics[7]->sgpa }}
                                        @else
                                            ---
                                        @endif</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mr-10">
                                <div class="text-center font-bold text-xl">
                                    CGPA: <span class="underline">{{ $academics[$student->current_sem-1]->cgpa }}</span>
                                </div>
                            </div>
                        </div>
                    <!-- <div class="basis-1/3 md:flex md:flex-col bg-green-600">
                        <div class="basis-1/5"></div>
                        <div class="basis-4/5 bg-purple-700">Comments/Reasons</div>
                    </div> -->
                    <div class="basis-1/3 bg-white rounded-xl">
                        <div class="p-6">
                            <div>
                                <h5 class="text-xl font-bold">Reasons/Comments</h5>
                                <div class="grad3"></div>
                                <div class="mt-3 text-lg">
                                    {{ $student->reason }}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div> 
            </div>   
        </div>
    </section>
</div>

@endsection

