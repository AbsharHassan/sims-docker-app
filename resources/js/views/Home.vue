<template>
    <div>
        <div class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]" :class="(showNavText)? 'xl:grid-cols-[120px_minmax(120px,_1fr)]' : 'xl:grid-cols-[60px_minmax(60px,_1fr)]'" >
            <Sidebar/>
            <Header/>
            <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)" class="bg-slate-300/40" :height="100" :width="100"/>    
            <div class="shadow-md m-5 px-5 pt-1 pb-5 hover:shadow-2xl transition duration-500 border-t-8 border-t-sky-500/20 lg:flex justify-evenly min-h-[85vh] xl:min-h-[90%]"> 
                <transition-group appear @before-enter="beforeEnter" @enter="enter">
                    <div :key="0" :data-index="0" class="mt-3 lg:mt-0 flex items-center justify-center">
                        <router-link :to="{name: 'AllCourseEntries'}" >
                            <HomeCard>
                                <template #svgSection>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journals w-[80%] h-[80%] text-black mt-2" viewBox="0 0 16 16">
                                        <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
                                        <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
                                    </svg>
                                </template>
                                <template #titleSection>Manage Courses</template>
                                <template #graphSection>
                                    <div class="mb-7 px-2 text-xs text-center font-medium uppercase text-slate-300">
                                        <div class="mb-2">
                                            Add and manage courses
                                        </div>
                                        <div>
                                            View courses stats and more
                                        </div>
                                    </div>
                                    <BarChart :chartData="barChartData" :chartOptions="barChartOptions" label="marks distribution" class="min-w-[200px] w-[90%] sm:w-[320px] h-[170px] sm:h-[200px] bg-black/40 hover:bg-black/70  rounded mx-auto transition-all duration-300 px-3"/>
                                </template>
                            </HomeCard>
                        </router-link>
                    </div>
                    <div :key="1" :data-index="1" class="flex justify-center items-center">
                        <router-link :to="{name: 'Dashboard'}">
                            <HomeCard>
                                <template #svgSection>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-mortarboard-fill w-[80%] h-[80%] text-black" viewBox="0 0 16 16">
                                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                                    </svg>
                                </template>
                                <template #titleSection>Manage Students</template>
                                <template #graphSection>
                                    <div class="mb-7 px-2 text-xs text-center font-medium uppercase text-slate-300">
                                        <div class="mb-2">
                                            Register and track students' progress
                                        </div>
                                        <div>
                                            View semester stats and more
                                        </div>
                                    </div>
                                    <LineChart :chartData="lineChartData" :chartOptions="lineChartOptions" label="marks distribution" class="min-w-[200px] w-[90%] sm:w-[320px] h-[170px] sm:h-[200px] bg-black/40 hover:bg-black/70  rounded mx-auto transition-all duration-300"/>
                                </template>
                            </HomeCard>
                        </router-link>
                    </div>
                </transition-group>
            </div>
        </div>
    </div>
</template>

<script>
import gsap from 'gsap'
import BarChart from '../components/BarChart.vue'
import LineChart from '../components/LineChart.vue'
import HomeCard from '../components/HomeCard.vue'
import Sidebar from '../components/Sidebar.vue'
import Header from '../components/Header.vue'
import Entries from '../components/Entries.vue'
import Button from '../components/Button.vue'
import { mapActions, mapGetters } from 'vuex'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
    name: 'Dashboard',
    components: {
        Sidebar,
        Header,
        Entries,
        Button,
        Loading,
        HomeCard,
        BarChart,
        LineChart
    },
    methods: {
        ...mapActions(['getAllEntries']),
        beforeEnter(el) {
            el.style.opacity = 0
            el.style.transform = 'translateY(-500px)'
        },
        enter(el, done) {
            gsap.to(el, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                onComplete: done,
                delay: el.dataset.index * 0.2
            })
        },
        switchData() {
            if(this.currentDataset == 0) {
                this.barChartData.datasets[0].data = [2, 4, 6, 13, 28, 6, 3, 4, 2, 2, 1]
                this.lineChartData.datasets[0].data = [3.6, 3.1, 3.5, 3.3, 3.2, 3.0, 2.7]
            } else if(this.currentDataset == 1) {
                this.barChartData.datasets[0].data = [12, 6, 7, 23, 15, 18, 9, 1, 6, 7, 3]
                this.lineChartData.datasets[0].data = [4, 4, 3.9, 3.8, 3.4, 3.6, 3.8]
            } else if(this.currentDataset == 2) {
                this.barChartData.datasets[0].data = [4, 8, 10, 25, 7, 19, 9, 9, 3, 12, 1]
                this.lineChartData.datasets[0].data = [2.7, 2.1, 2.4, 2.8, 3.0, 2.1, 3.5, 3.1]
            } else if(this.currentDataset == 3) {
                this.barChartData.datasets[0].data = [9, 11, 15, 26, 28, 18, 9, 9, 4, 2, 1]
                this.lineChartData.datasets[0].data = [3.6, 3.1, 3.5, 2.7]
            } else if(this.currentDataset == 4) {
                this.barChartData.datasets[0].data = [0, 1, 12, 2, 20, 18, 11, 4, 6, 7, 0]
                this.lineChartData.datasets[0].data = [3.0, 1.7, 3.1, 3.4, 3.6, 3.8]
            } else if(this.currentDataset == 5) {
                this.barChartData.datasets[0].data = [1, 10, 11, 5, 6, 7, 19, 24, 21, 7, 4]
                this.lineChartData.datasets[0].data = [2.3, 1.4, 0.6, 1.4, 0.3]
            }
            
            if(this.currentDataset < 5) {
                this.currentDataset++
            } else {
                this.currentDataset = 0 
            }
        }
    },
    created() {
        console.log('createdd')
        var dataSwitcherControl = setInterval(() => {
            this.switchData()
        }, 2000)
    },
    computed: {
        ...mapGetters(['allEntries', 'loadingStatus', 'isEmptyRespone', 'navWidth', 'showNavText']),
    },
    data() {
        return {
            currentDataset: 0,
            barChartData: {
                labels: [ '0 - 10', '10 - 20', '20 - 30', '30 - 40', '40 - 50', '50 - 60', '60 - 70', '70 - 80', '80 - 90', '90+' ],
                datasets: [ { 
                    label: 'Marks Distribution',
                    backgroundColor: 'rgb(14 165 233 / 0.75)',
                    maxBarThickness: 15,
                    data: [1, 10, 11, 5, 6, 7, 19, 24, 21, 7, 4] } ]
            },
            barChartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {  
                    legend: {
                        labels: {
                            color: "rgb(203 213 225 / 0.8)",
                            // font: {
                            //     size:
                            // }   
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display:false
                        },
                        ticks: {
                            color: "rgb(203 213 225 / 0.8)"
                        }
                    },
                    y: {
                        grid: {
                            display:false
                        },
                        ticks: {
                            color: "rgb(203 213 225 / 0.8)"
                        }
                    },
                }
            },
            lineChartData: {
                labels: [ '1st', '2nd', '3rd', '4th', '5th', '6th' , '7th', '8th' ],
                datasets: [ { 
                    label: 'Semester GPAs',
                    backgroundColor: 'rgb(14 165 233 / 0.75)',
                    tension: 0.2,
                    data: [3.8, 3.4, 3.4, 3.6, 3.7, 3.11, 2.68, 3.1] } ]
            },
            lineChartOptions: {
                responsive: true,
                lineWidth: 0,
                maintainAspectRatio: false,
                backgroundColor: 'rgb(14 165 233)',
                borderColor: ' rgb(14 165 233 )',
                hoverBorderColor: 'rgb(14 165 233 / 0.75)',
                pointBackgroundColor: 'black',
                pointRadius: 5,
                indexAxis: 'x',
                plugins: {  
                    legend: {
                        borderWidth: 0,
                        labels: {
                            color: "rgb(203 213 225 / 0.8)",
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display:false
                        },
                        ticks: {
                            color: "rgb(203 213 225 / 0.8)"
                        }
                    },
                    y: {
                        grid: {
                            display:false
                        },
                        ticks: {
                            color: "rgb(203 213 225 / 0.8)"
                        }
                    },
                }
            },
        }
    }
}
</script>

<style>

/* .entries-enter-from {
    opacity: 0;
    transform: translateY(-300px);
}
.entries-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.entries-enter-active {
    transition: all 0.5s ease;
}
.entries-move {
    transition: all 0.5s ease;
} */

</style>