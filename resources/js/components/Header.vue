<template>
    <transition name="header" appear>    
        <header class="sticky top-0 z-30">
        <div class="header-bg flex justify-center items-center h-[60px] shadow-md ">
            <div class="basis-[5%] flex justify-center mx-[10px]">
                <button @click="toggleSlideMenu(true)" class="w-full h-full">
                    <i class="bi bi-list text-3xl xl:hidden"></i>
                </button>
            </div>
            <div class="basis-[90%] ">
                    <h1 class="hidden sm:block self-center grow lg:text-3xl sm:text-2xl py-3 text-center font-bold text-gray-700 text-base">Student Information Management System</h1>
                    <h1 class="sm:hidden text-lg text-center font-bold text-gray-700 ">
                        S.I.M.S
                    </h1>
            </div>
            <div class="basis-[5%] mr-3 xl:hidden">
                <div class="hover:cursor-pointer " @click="showLogout(true)">
                    <div class="flex flex-col justify-center items-center">
                        <i class="bi bi-box-arrow-left text-xl"></i>
                        <span class="font-bold text-xs">
                            Logout
                        </span>
                    </div>
                </div>
            </div>
        </div>
        </header>
    </transition>    
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
    name: 'Header',
    methods: {
        ...mapActions(['showLogout', 'toggleSlideMenu']),
        // expandSidebar() {
        //     document.getElementById('slideBar').style.width = '150px'
        //     document.getElementById('slideBar').style.display = 'inline'
        // }
    },
    computed: {
        ...mapGetters(['showNavText'])
    }
}
</script>

<style>
.header-bg {
    background-color: rgb(239, 250, 252);
}

.header-enter-from {
    opacity: 0;
    transform: translateX(-150px);
    /* transform: scale(0); */
}
.header-enter-to {
    opacity: 1;
    transform: translateX(0);
    /* transform: scale(1); */
}
.header-enter-active {
    transition: all 0.5s ease;
}
.header-move {
    transition: all 0.5s ease;
}
</style>