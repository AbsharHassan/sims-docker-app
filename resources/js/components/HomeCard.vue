<template>
    <div>
        <div class="bg-cyan-900/60 w-[270px] sm:w-[370px] my-3 mx-5 rounded shadow-lg hover:shadow-2xl text-slate-200 hover:text-white hover:-translate-y-1 hover:bg-cyan-700/70 transition duration-500 h-[420px] sm:h-[450px]">
            <div class="w-full flex items-center">
                <div class="flex h-[130px]">
                    <div class="basis-[40%]">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-mortarboard-fill w-full h-full text-black" viewBox="0 0 16 16">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                        </svg> -->
                        <slot name="svgSection"></slot>
                    </div>
                    <div class="basis-[60%] text-slate-200 font-normal text-center text-base sm:text-3xl flex items-center  xl:text-5xl px-3">
                        <slot name="titleSection"></slot>
                    </div>
                </div>
            </div>
            <div class="h-[300px] mt-6">
                <slot name="graphSection"></slot>
            </div>
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

    },
    components: {

    },
    data() {
        return {
            
        }
    },
    methods: {

    },
    created() {

    }
}
</script>

<style>

</style>