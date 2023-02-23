<template>
    <div class="bg-white/40 w-full mb-6 border-2 border-white/10 rounded-sm shadow-lg p-3 sm:p-5 hover:shadow-2xl hover:border-2 hover:border-blue-300 transition duration-500 pt-5">
        <h3 class=" text-xl font-bold">GPA Standing</h3>
        <div class="grad3 w-[300px]"></div>
        <div class="md:flex py-6 h-full">
            <div class="basis-2/3">
                <div class="md:flex bg-white/50 py-6 px-3 md:mr-5 mb-6 md:mb-0 border-2 border-white/10 hover:border-blue-300 transition duration-500 rounded ">
                    <div class="sm:flex">
                        <div class="basis-1/2">
                            <div v-for="number in 4" :key="number">
                                <BasicEntry :title="number" semesterTitle="Semester" :value="(number <= currentSem) ? singleAcademics[`${number - 1}`].sgpa : '--'" :widthValue=" (width > '1024') ? '95px' : '' " @click="revealSemesterInfo(number), loadingOpacityModifier()"/>
                            </div>
                        </div>
                        <div class="basis-1/2">
                            <div v-for="number in 4" :key="number">
                                <BasicEntry :title="number + 4" semesterTitle="Semester" :value="((number + 4) <= currentSem) ? singleAcademics[`${number - 1 + 4}`].sgpa : '--'" :widthValue=" (width > '1024') ? '95px' : '' " @click="revealSemesterInfo(number + 4), loadingOpacityModifier()"/>
                            </div>
                        </div>
                    </div>
                    <div v-if="width < '768'" class="block">
                        <div class="text-center font-bold text-xl mt-6">
                            CGPA: <span class="underline"> {{singleAcademics.latest_cgpa}} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="basis-1/3">
                <div class="bg-white/50 p-6 border-2 border-white/10 hover:border-blue-300 transition duration-500 rounded h-full">
                    <div>
                        <h5 class="text-xl font-bold">Reasons/Comments</h5>
                        <div class="grad3"></div>
                        <div class="mt-3 text-lg">
                            {{ reasons }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="width >= '768'">
            <div class="text-center font-bold text-xl">
                CGPA: <span class="underline">{{singleAcademics.latest_cgpa}}</span>
            </div>
        </div>
    </div>
</template>

<script>
import BasicEntry from './BasicEntry.vue'

export default {
    name: 'GPASection',
    props: {
        singleAcademics: Object,
        currentSem: Number,
        reasons: String
    },
    components: {
        BasicEntry
    },
    data() {
        return {
           width: window.innerWidth,
        }
    },
    methods: {
        widthWatcher() {
            this.width = window.innerWidth
        },
        loadingOpacityModifier() {
            this.$emit('loadingOpacityModifier')
        },
        revealSemesterInfo(number) {
            this.$emit('revealSemesterInfo', number)
        }
    },
    created() {
        window.addEventListener("resize", this.widthWatcher);
    },
    destroyed() {
        window.removeEventListener("resize", this.widthWatcher);
    },
}
</script>

<style>

</style>