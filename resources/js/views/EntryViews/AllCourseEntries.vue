<template>
    <div>
        <Loading
            v-model:active="loadingStatus"
            loader="bars"
            color="rgb(2 132 199 / 0.75)"
            class="bg-slate-300/40"
            :height="100"
            :width="100"
        />
        <div
            class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]"
            :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`"
        >
            <Sidebar />
            <Header />
            <transition name="courseEntries" appear>
                <div
                    class="shadow-md m-5 px-5 pt-1 pb-5 hover:shadow-2xl transition duration-500 border-t-8 border-t-sky-500/20"
                >
                    <div class="sm:flex items-baseline justify-between">
                        <div
                            class="text-slate-600 text-lg font-bold flex mt-4 justify-center items-center mb-5 sm:mb-0"
                        >
                            Click to view full details
                        </div>
                        <div class="mb-5 sm:mb-0">
                            <router-link :to="{ name: 'CreateCourse' }">
                                <Button
                                    text="Create New Course"
                                    class="text-sm rounded-md px-2 py-[5px] grow-0 bg-sky-700 hover:bg-black mb-3 w-full"
                                >
                                    <template #extraText v-if="loadingStatus">
                                        Processing
                                    </template>
                                    <template #spinnerIcon v-if="loadingStatus">
                                        <span>
                                            <i class="bi bi-arrow-repeat"></i>
                                        </span>
                                    </template>
                                </Button>
                            </router-link>
                        </div>
                    </div>
                    <div
                        v-if="isEmptyRespone"
                        class="text-center my-72 text-sky-600 text-lg sm:text-4xl font-semibold"
                    >
                        No courses have been created yet
                    </div>
                    <div v-else class="sm:flex flex-wrap justify-center">
                        <div
                            v-for="course in coursesArray"
                            :key="course.course_id"
                        >
                            <div>
                                <router-link
                                    :to="{
                                        name: 'SingleCourse',
                                        params: { course_id: course.course_id },
                                    }"
                                >
                                    <transition name="entries" appear>
                                        <CourseEntry :course="course" />
                                    </transition>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="bg-white/40 w-full mx-auto border-2 border-white/10 rounded-sm shadow-lg p-3 sm:p-5 hover:shadow-2xl hover:border-2 hover:border-blue-300 transition duration-500 pt-5">
                        <div v-if="isEmptyRespone" class="text-center my-72 text-sky-600 text-lg sm:text-4xl font-semibold">
                            No courses have been added yet
                        </div>
                        <div v-else>
                            <div v-for="entry in coursesArray" :key="entry.id">
                                <router-link :to="{name: 'StudentEntry', params: {student_id: entry.id}}">
                                    <transition name="entries" appear>
                                        <Entries :entry="entry"/>
                                    </transition>
                                </router-link>
                            </div>
                        </div>
                        <div v-for="course in coursesArray" :key="course.course_id">
                            <div>
                                <router-link :to="{name: 'CreateCourse'}">
                                    <transition name="entries" appear>
                                        <CourseEntry :course="course"/>
                                    </transition>
                                </router-link>
                            </div>
                        </div>
                    </div> -->
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/Sidebar.vue";
import Header from "../../components/Header.vue";
import Entries from "../../components/Entries.vue";
import Button from "../../components/Button.vue";
import { mapActions, mapGetters } from "vuex";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import CourseEntry from "../../components/CourseEntry.vue";

export default {
    name: "Dashboard",
    components: {
        Sidebar,
        Header,
        Entries,
        Button,
        Loading,
        CourseEntry,
    },
    methods: {
        ...mapActions(["getAllCourses"]),
    },
    computed: {
        ...mapGetters([
            "allCourses",
            "loadingStatus",
            "isEmptyRespone",
            "navWidth",
        ]),
        coursesArray() {
            return this.$store.getters.allCourses[
                this.$store.getters.allCourses.length - 1
            ];
        },
    },
    async created() {
        await this.getAllCourses();
    },
};
</script>

<style>
.courseEntries-enter-from {
    opacity: 0;
    transform: translateY(-300px);
}
.courseEntries-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.courseEntries-enter-active {
    /* transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); */
    transition: all 0.5s linear;
}
.courseEntries-move {
    /* transition: all 0.5s ease; */
    transition: all 0.5s linear;
}
</style>
