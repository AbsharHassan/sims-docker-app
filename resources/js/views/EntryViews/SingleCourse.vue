<template>
    <div>
        <Loading
            v-model:active="loadingStatus"
            loader="bars"
            color="rgb(2 132 199 / 0.75)"
            :height="100"
            :width="100"
            :on-cancel="onCancel"
            :can-cancel="loadingCancel"
            background-color="rgb(203 213 225)"
            :opacity="loadingOpacity"
        />
        <div
            class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]"
            :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`"
        >
            <Sidebar />
            <Header />
            <div class="shadow-md m-5 p-5 flex justify-center">
                <div
                    class="bg-slate-100/60 mb-5 w-[90%] sm:w-[75%] xl:w-[60%] sm:mx-5 flex flex-col items-center pt-3 pb-0 rounded-md shadow-md border-2 border-transparent hover:shadow-2xl hover:border-cyan-600 hover:bg-white/60 transition duration-500 mx-auto"
                >
                    <div
                        class="bg-sky-500/20 mb-2 w-full flex items-center justify-between px-1"
                    >
                        <router-link :to="{ name: 'AllCourseEntries' }">
                            <div
                                class="basis-[7%] text-sm sm:text-base flex items-baseline hover:underline hover:underline-offset-2"
                            >
                                <div>
                                    <i class="bi bi-arrow-left"></i>
                                </div>
                                <div>Back</div>
                            </div>
                        </router-link>
                        <div
                            class="text-slate-600 my-3 text-center font-semibold text-base sm:text-xl basis-[86%]"
                        >
                            Course ID: {{ singleCourse.course_id }}
                        </div>
                        <router-link
                            :to="{
                                name: 'EditCourse',
                                params: { course_id: $route.params.course_id },
                            }"
                        >
                            <div
                                class="basis-[7%] text-sm sm:text-base flex items-baseline"
                            >
                                <div class="mr-2">Edit</div>
                                <div>
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div
                        class="w-full mt-3 sm:mt-0 h-[200px] sm:h-[350px] py-2 sm:py-0 border-y-2 border-y-slate-200 flex items-center justify-center"
                    >
                        <div v-if="histogram">
                            <BarChart
                                :chartData="chartData"
                                :chartOptions="chartOptions"
                                label="marks distribution"
                                class="min-w-[190px] w-[99%] sm:w-[300px] h-[190px] sm:h-[300px]"
                            />
                        </div>
                        <div v-else class="text-sky-500">
                            Course data not available.
                        </div>
                    </div>
                    <div class="flex my-1 px-2 mt-2 w-full">
                        <BasicEntry
                            title="Title"
                            :value="singleCourse.course_name"
                            class="w-full"
                            :key="getRefresh"
                        />
                    </div>
                    <div class="flex my-1 px-2 mt-2 w-full">
                        <BasicEntry
                            title="Code"
                            :value="singleCourse.course_code"
                            class="w-full"
                            :key="getRefresh"
                        />
                    </div>
                    <div class="flex my-1 px-2 mt-2 w-full">
                        <BasicEntry
                            title="Average"
                            :value="singleCourse.average"
                            class="w-full"
                            :key="getRefresh"
                        />
                    </div>
                    <div class="flex my-1 px-2 mt-2 w-full">
                        <BasicEntry
                            title="Std Deviation"
                            :value="singleCourse.std_dev"
                            class="w-full"
                            :key="getRefresh"
                        />
                    </div>
                    <div class="my-1 px-2 w-full mt-4">
                        <div class="font-medium text-center">Description:</div>
                        <div
                            class="bg-slate-400/75 rounded-sm w-full my-2 px-2 text-center min-h-[50px] flex items-center justify-center overflow-hidden"
                            :key="getRefresh"
                        >
                            <p class="">
                                {{ singleCourse.course_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BasicEntry from "../../components/BasicEntry.vue";
import axios from "axios";
import "vue-loading-overlay/dist/vue-loading.css";
import Loading from "vue-loading-overlay";
import { mapActions, mapGetters } from "vuex";
import BarChart from "../../components/BarChart.vue";
import Sidebar from "../../components/Sidebar.vue";
import Header from "../../components/Header.vue";

export default {
    name: "CourseEntry",
    props: {
        course: Object,
    },
    components: {
        BasicEntry,
        BarChart,
        Loading,
        Sidebar,
        Header,
    },
    data() {
        return {
            WindowWidth: window.innerWidth,
            chartData: {
                labels: [],
                datasets: [
                    {
                        label: "Marks Distribution",
                        backgroundColor: "rgb(14 165 233 / 0.75)",
                        data: [],
                    },
                ],
            },
            histogram: null,
            grade: this.subjectGrade,
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false,
            },
            loadingCancel: true,
        };
    },
    computed: {
        ...mapGetters([
            "singleCourse",
            "loadingStatus",
            "navWidth",
            "getRefresh",
        ]),
    },
    methods: {
        ...mapActions(["setLoadingStatus", "getSingleCourse"]),
        onCancel() {
            this.$router.push({ name: "AllCourseEntries" });
        },
        widthWatcher() {
            this.width = window.innerWidth;
        },
        async getSubjectHistogram(id) {
            this.setLoadingStatus(true);

            await axios
                .get(`/api/courses/histogram/${id}`, {
                    headers: {
                        Accept: "application/json",
                        Authorization: `Bearer ${sessionStorage.getItem(
                            "AUTH-TOKEN"
                        )}`,
                    },
                })
                .then((response) => {
                    if (response.data) {
                        if (response.data.length) {
                            this.histogram = response.data;
                            for (let x = 0; x < this.histogram.length; x++) {
                                if (x < this.histogram.length - 1) {
                                    this.chartData.labels[x] =
                                        this.histogram[x].bin.toString() +
                                        "-" +
                                        this.histogram[x + 1].bin.toString();
                                } else {
                                    this.chartData.labels[x] =
                                        this.histogram[x].bin.toString() + "+";
                                }
                                this.chartData.datasets[0].data[x] =
                                    this.histogram[x].count;
                            }
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                });

            this.setLoadingStatus(false);
        },
    },
    async created() {
        this.loadingOpacity = 1;
        await this.getSingleCourse(this.$route.params.course_id);
        await this.getSubjectHistogram(this.$route.params.course_id);
    },
    destroyed() {
        this.loadingOpacity = 0.4;
    },
};
</script>

<style></style>
