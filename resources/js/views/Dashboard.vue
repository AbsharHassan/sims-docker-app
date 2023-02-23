<template>
    <div>
        <div
            class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]"
            :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`"
        >
            <Sidebar />
            <Header />
            <Loading
                v-model:active="loadingStatus"
                loader="bars"
                color="rgb(2 132 199 / 0.75)"
                class="bg-slate-300/40"
                :height="100"
                :width="100"
            />
            <transition name="entries" appear>
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
                            <router-link :to="{ name: 'CreateEntry' }">
                                <Button
                                    text="Create New Entry"
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
                        class="bg-white/40 w-full mx-auto border-2 border-white/10 rounded-sm shadow-lg p-3 sm:p-5 hover:shadow-2xl hover:border-2 hover:border-blue-300 transition duration-500 pt-5"
                    >
                        <div
                            v-if="isEmptyRespone"
                            class="text-center my-72 text-sky-600 text-lg sm:text-4xl font-semibold"
                        >
                            No student entries have been created yet
                        </div>
                        <div v-else>
                            <div v-for="entry in entriesArray" :key="entry.id">
                                <router-link
                                    :to="{
                                        name: 'StudentEntry',
                                        params: { student_id: entry.id },
                                    }"
                                >
                                    <!-- <transition name="entries" appear> -->
                                    <Entries :entry="entry" :key="getRefresh" />
                                    <!-- </transition> -->
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import Sidebar from "../components/Sidebar.vue";
import Header from "../components/Header.vue";
import Entries from "../components/Entries.vue";
import Button from "../components/Button.vue";
import { mapActions, mapGetters } from "vuex";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    name: "Dashboard",
    components: {
        Sidebar,
        Header,
        Entries,
        Button,
        Loading,
    },
    methods: {
        ...mapActions(["getAllEntries"]),
    },
    computed: {
        ...mapGetters([
            "allEntries",
            "loadingStatus",
            "isEmptyRespone",
            "navWidth",
            "getRefresh",
        ]),
        entriesArray() {
            return this.$store.getters.allEntries[
                this.$store.getters.allEntries.length - 1
            ];
        },
    },
    async created() {
        await this.getAllEntries();
    },
};
</script>

<style>
.entries-enter-from {
    opacity: 0;
    transform: translateY(-300px);
}
.entries-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.entries-enter-active {
    /* transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); */
    transition: all 0.5s linear;
}
.entries-move {
    /* transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); */
    transition: all 0.5s linear;
}
</style>
