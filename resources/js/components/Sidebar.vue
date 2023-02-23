<template>
    <transition name="sidebar" appear>
        <aside
            class="hidden xl:block transition-all duration-500 sticky top-0 h-screen text-white shadow-xl bg-gradient-to-r from-cyan-900 to-cyan-900/70 row-span-2 col-span-1 items-start z-40 navbar"
            :class="showNavText ? 'w-[120px]' : 'w-[60px]'"
        >
            <div>
                <div class="font-bold">
                    <div class="flex justify-center items-center h-[60px]">
                        <h2
                            v-if="showNavText"
                            class="align-center text-center text-2xl font-bold"
                        >
                            Admin
                        </h2>
                    </div>
                </div>
            </div>
            <div id="grad1"></div>
            <!-- <hr class="text-blue-500 bg-blue-500"> -->
            <!-- <div class="p-2.5 mt-3 flex items-baseline justify-start px-4 duration-300 cursor-pointer bg-sky-300/50  text-white">
                <input type="text" placeholder="Search" class="text-[15px]  mt-1 w-full bg-transparent focus:outline-0">
                <i class="bi bi-search text-sm"></i>
            </div> -->
            <div class="grad2"></div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
            >
                <router-link :to="{ name: 'Home' }" class="w-full py-4 px-2">
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-house-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Home
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
            >
                <router-link
                    :to="{ name: 'ListUsers' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex pl-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-people-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Users
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
            >
                <router-link
                    :to="{ name: 'Dashboard' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-mortarboard-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Students
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
            >
                <router-link
                    :to="{ name: 'AllCourseEntries' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-book-half"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Courses
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white py-4 px-2 flex items-center hover:bg-cyan-600 transition-all duration-300 hover:cursor-pointer w-full"
                @click="showLogout(true)"
            >
                <div class="flex px-1.5 w-full items-center">
                    <div class="basis-[30%]">
                        <i
                            class="bi bi-box-arrow-left text-xl"
                            :class="!showNavText ? 'text-2xl' : ''"
                        ></i>
                    </div>
                    <div v-if="showNavText" class="basis-[70%] text-white ml-1">
                        Logout
                    </div>
                </div>
            </div>
            <!-- <div class="grad2"></div>
            <div class="py-4 px-2 flex items-center ">
                <a href="#" class="w-[100%] ml-3">User</a>
            </div>
            <div class="grad2"></div>
            <div class="mt-3 p-2 flex items-center ">
                <a href="#" class="w-[100%] ml-3">Students</a>
            </div>
            <div class="grad2"></div>
            <div>
                <router-link :to="{name: 'AllCourseEntries'}">Courses</router-link>    
            </div>       -->
            <div class="w-full">
                <!-- <div class="text-slate-500 hover:text-white absolute ml-5 bottom-[100px] hover:cursor-pointer hover:bg-cyan-600 transition-all duration-300">
                        <button class="w-full bg-transparent" @click="showLogout(true)">
                            <div class="flex justify-end items-center">
                                <i class="bi bi-box-arrow-left"></i>
                                <span class="ml-1 mt-1 text-white">
                                    Logout
                                </span>
                            </div>
                        </button>
                    </div> -->
                <!-- <div class="text-slate-400 hover:text-white py-4 px-2 flex items-center hover:bg-cyan-600 transition-all duration-300 absolute bottom-[200px] hover:cursor-pointer w-full" @click="showLogout(true)">
                    <div class="flex px-2 w-full items-center">
                        <div class="basis-[33%]">
                            <i class="bi bi-box-arrow-left text-xl" :class="!showNavText ? 'text-3xl':''"></i>
                        </div>
                        <div v-if="showNavText" class="basis-[67%] text-white">
                            Logout
                        </div>
                    </div>
                </div> -->
                <div
                    class="hover:cursor-pointer flex items-center py-4 w-full absolute bottom-[300px] text-2xl text-right px-4 text-slate-300 hover:text-white"
                    @click="toggleNavWidth(60), rotateIcon()"
                    :class="showNavText ? 'justify-end' : 'jusitfy-center'"
                >
                    <div id="expanderIcon" class="w-[30px] toggler">
                        <i class="bi bi-arrow-bar-left"></i>
                    </div>
                </div>
            </div>
        </aside>
    </transition>
    <transition name="slideMenu">
        <aside
            v-if="showSlideMenu"
            id="slideBar"
            class="xl:hidden transition-all duration-500 w-[150px] fixed top-0 left-0 h-screen text-white shadow-xl bg-gradient-to-r from-cyan-900 to-cyan-900/70 z-40"
        >
            <div
                class="w-full py-4 px-2 text-slate-400 hover:text-white flex items-center"
            >
                <div class="w-full flex justify-end px-2 text-3xl">
                    <button @click="toggleSlideMenu(false)">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div
                class="text-slate-200 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
                @click="toggleSlideMenu(false)"
            >
                <router-link :to="{ name: 'Home' }" class="w-full py-4 px-2">
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-house-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Home
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
                @click="toggleSlideMenu(false)"
            >
                <router-link
                    :to="{ name: 'ListUsers' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex pl-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-people-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Users
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
                @click="toggleSlideMenu(false)"
            >
                <router-link
                    :to="{ name: 'Dashboard' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-mortarboard-fill"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Students
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white flex items-center hover:bg-cyan-600 transition-all duration-300"
                @click="toggleSlideMenu(false)"
            >
                <router-link
                    :to="{ name: 'AllCourseEntries' }"
                    class="w-full py-4 px-2"
                >
                    <div class="flex px-2">
                        <div class="basis-[30%]">
                            <i
                                class="bi bi-book-half"
                                :class="!showNavText ? 'text-2xl' : ''"
                            ></i>
                        </div>
                        <div v-if="showNavText" class="basis-[70%] text-white">
                            Courses
                        </div>
                    </div>
                </router-link>
            </div>
            <div
                class="text-slate-400 hover:text-white py-4 px-2 flex items-center hover:bg-cyan-600 transition-all duration-300 hover:cursor-pointer w-full"
                @click="showLogout(true)"
            >
                <div class="flex px-1.5 w-full items-center">
                    <div class="basis-[30%]">
                        <i
                            class="bi bi-box-arrow-left text-xl"
                            :class="!showNavText ? 'text-2xl' : ''"
                        ></i>
                    </div>
                    <div v-if="showNavText" class="basis-[70%] text-white ml-1">
                        Logout
                    </div>
                </div>
            </div>
        </aside>
    </transition>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "Sidebar",
    methods: {
        ...mapActions(["showLogout", "toggleNavWidth", "toggleSlideMenu"]),
        rotateIcon() {
            if (!this.showNavText) {
                document.getElementById("expanderIcon").style.rotate = "180deg";
            } else {
                document.getElementById("expanderIcon").style.rotate = "0deg";
            }
        },
        // closeSidebar() {
        //     document.getElementById('slideBar').style.width = '0'
        //     document.getElementById('slideBar').style.display = 'none'
        // }
    },
    computed: {
        ...mapGetters(["navWidth", "showNavText", "showSlideMenu"]),
    },
};
</script>

<style>
.slideMenu-enter-from,
.slideMenu-leave-to {
    opacity: 0;
    transform: translateX(-150px);
}
.slideMenu-enter-to,
.slideMenu-leave-from {
    opacity: 1;
    transform: translateX(0);
}
.slideMenu-enter-active,
.slideMenu-leave-active {
    transition: all 0.3s ease;
}
.slideMenu-move {
    transition: all 0.3s ease;
}

.navbar {
    transition: all 0.1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.toggler {
    transition: all 0.2s ease;
    /* animation: sidebarToggler 5s linear ; */
}

@keyframes sidebarToggler {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(180deg);
    }
}

.sidebar-enter-from {
    opacity: 0;
    transform: translateX(-150px);
}
.sidebar-enter-to {
    opacity: 1;
    transform: translateX(0);
}
.sidebar-enter-active {
    transition: all 0.5s ease;
}
.sidebar-move {
    transition: all 0.5s ease;
}
</style>
