<template>
    <div class="bg-white/40 w-full mb-6 border-2 border-white/10 rounded-sm shadow-lg p-3 sm:p-5 hover:shadow-2xl hover:border-2 hover:border-blue-300 transition duration-500 pt-5">
        <h3 class=" text-xl font-bold">Education History</h3>
        <div class="grad3 w-[300px]"></div>
        <div class="h-full sm:flex justify-between py-6 pr-0 lg:pr-6">
            <div class="h-full sm:basis-1/2">
                <BasicEntry title="HSSC (FSC)" :value="singleStudent.fsc_marks" :underlineControl="width > '768' ? false : true" class="lg:w-[80%] sm:mr-3 md:flex"/>
            </div>
            <div class="h-full sm:basis-1/2">
                <BasicEntry title="SSC (Matric)" :value="singleStudent.matric_marks" :underlineControl="width > '768' ? false : true" class="lg:w-[80%] md:flex"/>
            </div>
        </div>
    </div>
</template>

<script>
import BasicEntry from './BasicEntry.vue'

export default {
    name: 'EducationHistory',
    props: {
        singleStudent: Object
    },
    components: {
        BasicEntry,
    },
    data() {
        return {
            width: window.innerWidth
        }
    },
    methods: {
        widthWatcher() {
            this.width = window.innerWidth
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