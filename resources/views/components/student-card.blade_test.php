@props(['student'])

<div class="bg-white space-y-3 p-4 rounded-lg shadow-md">
    <div class="sm:flex sm:justify-between sm:items-center text-sm sm:space-x-2 space-y-4 sm:space-y-0">
        <div>
            <a href="/students/{{ $student->id }}" class="text-blue-500 font-bold text-sm hover:underline">{{ 'ID: ' . $student->id }}</a>
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