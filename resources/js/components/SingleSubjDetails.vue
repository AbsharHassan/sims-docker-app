<template>
    <div class="text-sm bg-white/90 mt-2 rounded px-3 border-2 shadow-lg hover:shadow-2xl border-blue-300 hover:border-sky-700 transition duration-500 text-black mb-5 hover:-translate-y-2">
      <div class="">
            <div class="h-[200px] w-[200px] sm:h-[250px] sm:w-[300px] flex justify-center items-center mt-3 mb-0 overflow-hidden">
                <div v-if="histogram">
                    <BarChart :chartData="chartData" :chartOptions="chartOptions" label="marks distribution" class="w-[180px] h-[180px] sm:w-[250px] sm:h-[250px]"/>
                </div>
                <div v-else class="text-sky-500">
                    Course data not available. 
                </div>
            </div>
            <hr class="mt-0">
            <div class=" mb-1 text-xs">
                <label for="subj_credit_1" class="inline-block text-md mb-1 font-medium">Subject Title</label>
                <div class="bg-slate-200 rounded p-[2px] text-center w-full" @click="show()">{{ subjectTitle }}</div>
            </div>
            <div class=" mb-1 text-xs">
                <label for="subj_credit_1" class="inline-block text-md mb-1 font-medium">Credit Hours</label>
                <div class="bg-slate-200 rounded p-[2px] text-center w-full ">{{ subjectCredit }}</div>
            </div>
            <div class="mb-3 text-xs">
                <label for="subj_grade_1" class="inline-block text-md mb-1 font-medium">Grade Obtained</label>
                <div class="bg-slate-200  rounded p-[2px] text-center w-full ">{{ grade }}</div>
            </div>
      </div>
    </div>
</template>

<script>
import axios from 'axios'
import 'vue-loading-overlay/dist/vue-loading.css';
import { mapActions } from 'vuex'
import BarChart from './BarChart.vue'

export default {
    name: 'SingleSubjDetails',
    props: {
        subjectId: [String, Number],
        subjectTitle: String,
        subjectCredit: Number,
        subjectGrade: String
    },
    components: {
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
                    data: [] } ]
            },
            histogram: null,
            grade: this.subjectGrade,
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            }
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
                    this.histogram = response.data
                    for (let x = 0; x < this.histogram.length; x++) {
                        if(x<this.histogram.length - 1) {
                            this.chartData.labels[x] = this.histogram[x].bin.toString() + '-' + this.histogram[x+1].bin.toString()
                        } else {
                            this.chartData.labels[x] = this.histogram[x].bin.toString() + '+'
                        }
                        this.chartData.datasets[0].data[x] = this.histogram[x].count
                    }
                }
            }).catch(error => {
                console.log(error)
            })

            this.setLoadingStatus(false)
        }
    },
    created() {
        this.getSubjectHistogram(this.subjectId)
        window.addEventListener("resize", this.widthWatcher);
        if(this.grade == 4) {
            this.grade = 'A'
        } else if(this.grade == 3.5) {
            this.grade = 'B+'
        } else if(this.grade == 3.0) {
            this.grade = 'B'
        } else if(this.grade == 2.5) {
            this.grade = 'C+'
        } else if(this.grade == 2.0) {
            this.grade = 'C'
        } else if(this.grade == 1.5) {
            this.grade = 'D+'
        } else if(this.grade == 1.0) {
            this.grade = 'D'
        } else if(this.grade == 0.0) {
            this.grade = 'F'
        } 
    },
    destroyed() {
        window.removeEventListener("resize", this.widthWatcher);
    }
}
</script>

<style>

</style>