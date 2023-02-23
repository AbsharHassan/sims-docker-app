<header class="theme-bg sticky top-0">
    <div class="flex items-center h-[75px] shadow-md">
        <div class="basis-1/10 self-center mx-[10px] md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </div>
        <div class="w-full">
            <div class="flex justify-center">
                <h1 class="self-center grow lg:text-2xl sm:text-xl py-3 text-center font-bold text-gray-700 text-base">Student Information Management System</h1>
                <div class="hidden text-xs self-center pr-1.5 sm:block">
                    <a href="/register"><i class="fa-solid fa-user-plus mr-1 it"></i>Register</a>
                </div>
                <div class="hidden text-xs self-center pr-2 sm:block">
                    <form action="/logout" method="POST">
                        @csrf 
                        <button type="submit">
                            <i class="fa-solid fa-door-open mr-1"></i>Logout    
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </header>