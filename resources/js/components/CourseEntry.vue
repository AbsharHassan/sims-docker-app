<template>
    <div>
        <div class="bg-slate-100/60 mb-5 min-w-[200px] w-[85%] sm:w-[400px] sm:mx-5 flex flex-col items-center pt-3 pb-0 rounded-md shadow-md border-2 border-transparent hover:shadow-2xl hover:border-cyan-600 hover:-translate-y-1 hover:bg-white/60 transition duration-500 mx-auto">
            <div class="bg-sky-500/20 h-[20px] mb-2 w-full flex items-start justify-center">
                <div class="text-slate-600 mb-1 font-medium">
                    Course ID: {{ course.course_id }}
                </div>
            </div>
            <div class="w-full mt-3 sm:mt-0 sm:h-[150px] py-2 sm:py-0 border-y-2 border-y-slate-200 flex items-center justify-center">
                <div v-if="histogram">
                    <BarChart :chartData="chartData" :chartOptions="chartOptions" label="marks distribution" class="min-w-[200px] w-[99%] sm:w-[400px] h-[180px] sm:h-[150px]"/>
                </div>
                <div v-else class="text-sky-500">
                    Course data not available. 
                </div>
            </div>
            <div class="flex my-1 px-2 mt-2 w-full">
                <BasicEntry title="Title" :value="course.course_name" class="w-full"/>
            </div>
            <div class="flex my-1 px-2 mt-2 w-full">
                <BasicEntry title="Code" :value="course.course_code" class="w-full"/>

                <!-- <div class="font-bold text-lg">
                    Course Code:
                </div>
                <div class="font-medium text-lg">
                    {{ course.course_code }}
                </div> -->
            </div>
            <!-- <div class="flex my-1">
                <BasicEntry title="Description" :value="course.course_description" class="overflow-elipsis"/>

                <div class="font-bold text-lg">
                    Description:
                </div>
                <div class="font-medium text-lg overflow-hidden overflow-ellipsis">
                    {{ course.course_description }}
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
import BasicEntry from './BasicEntry.vue'
import axios from 'axios'
import 'vue-loading-overlay/dist/vue-loading.css';
import { mapActions } from 'vuex'
import BarChart from './BarChart.vue'

export default {
    name: 'CourseEntry',
    props: {
        course: Object
    },
    components: {
        BasicEntry,
        BarChart
    },
    data() {
        return {
            WindowWidth: window.innerWidth,
            chartData: {
                labels: [],
                datasets: [ { 
                    label: 'Marks Distribution',
                    backgroundColor: 'rgb(14 165 233 / 0.75)',
                    maxBarThickness: 15,
                    data: [] } ]
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            },
            histogram: null,
            grade: this.subjectGrade,
        }
    },
    methods: {
        ...mapActions(['setLoadingStatus']),
        
        widthWatcher() {
            this.width = window.innerWidth
        },
        async getSubjectHistogram(id) {
            
            this.setLoadingStatus(true)

            await axios.get(`/api/courses/histogram/${id}`, {
                headers: {
                    Accept: "application/json",
                    'Authorization': `Bearer ${sessionStorage.getItem('AUTH-TOKEN')}`
                }
            })
            .then(response => {
                if(response.data) {
                    if(response.data.length) {
                        this.histogram = response.data
                        console.log(this.histogram)
                        for (let x = 0; x < this.histogram.length; x++) {
                            if(x<this.histogram.length - 1) {
                                this.chartData.labels[x] = this.histogram[x].bin.toString() + '-' + this.histogram[x+1].bin.toString()
                            } else {
                                this.chartData.labels[x] = this.histogram[x].bin.toString() + '+'
                            }
                            this.chartData.datasets[0].data[x] = this.histogram[x].count
                        }
                    }
                }
                console.log(this.chartData)
            }).catch(error => {
                console.log(error)
            })

            this.setLoadingStatus(false)
        }
    },
    created() {
        this.getSubjectHistogram(this.course.course_id)
    }
}
</script>

<style>

</style>