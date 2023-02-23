@props(['student'])

<div class="bg-white space-y-1 p-[1px] rounded-lg shadow-md mb-5">
    <div class="m-10 grid xl:grid-cols-8 lg:grid-cols-6 md:grid-cols-5 sm:grid-cols-5 gap-0 space-y-3 sm:space-y-0">
        <div class="overflow-hidden">
            <a href="/students/{{ $student->students_id }}" class="text-blue-500 font-bold text-sm hover:underline">{{ 'ID: ' . $student->students_id }}</a>
        </div>
        <div class="col-span-2 overflow-hidden">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'Name: ' . $student->name }}</span>
        </div>
        <div class="overflow-hidden">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'Age:' . $student->age }}</span>
        </div>
        <div class="overflow-hidden hidden sm:block">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'CGPA: ' . $student->CGPA }}</span>
        </div>
        <div class="overflow-hidden hidden lg:block">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'SGPA: ' . $student->SGPA }}</span>
        </div>
        <div class="overflow-hidden hidden xl:block">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'FSC: ' . $student->FSC }}</span>
        </div>
        <div class="overflow-hidden hidden xl:block">
            <span class="p-1.5 tracking-wider text-slate-800 bg-sky-400 rounded-xl bg-opacity-50">{{ 'Matric: ' . $student->Matric }}</span>
        </div>
    </div>
</div>

        
