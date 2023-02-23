<template>
    <div class="bg-white/40 w-full mb-6 border-2 border-white/10 rounded-sm shadow-lg p-3 sm:p-5 hover:shadow-2xl hover:border-2 hover:border-blue-300 transition duration-500 pt-5">
        <h3 class=" text-xl font-bold">Basic Information</h3>
        <div class="grad3 w-[300px]"></div>
        <div class="md:flex md:flex-row-reverse basis-2/6 py-6 pr-0 lg:pr-6">
            <div class="basis-1/3 lg:basis-1/4 flex justify-center md:justify-end mb-6 md:mb-0 p-1">
                <img src="/images/pfp.jpg" class="max-h-[200px] w-auto w-min-[100px]"  alt="">
            </div>
            <div class="basis-2/3 lg:basis-3/4  md:text-sm lg:text-base">
                <div class="sm:flex h-full justify-between">
                    <div class="basis-1/2 h-full flex flex-col justify-between">
                        <BasicEntry title="Name" :value="singleStudent.first_name + ' ' + singleStudent.last_name"/>
                        <BasicEntry title="DOB (Age)" :value="singleStudent.dob" :age="singleStudent.age"/>
                        <BasicEntry title="Joining Date" :value="singleStudent.joining_date"/>
                        <BasicEntry title="Degree" :value="singleStudent.degree"/>
                    </div>
                    <div class="basis-1/2 h-full flex flex-col justify-between  ">
                        <BasicEntry title="Department" :value="singleStudent.department"/>
                        <BasicEntry title="Semester" :value="singleStudent.current_sem"/>
                        <BasicEntry title="Father's Name" :value="singleFamily.father_name"/>
                        <BasicEntry title="CMS ID" :value="singleStudent.id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BasicEntry from './BasicEntry.vue'

export default {
    name:'BasicInfo',
    props: {
        singleStudent: {
            type: Object,
            default: {},
        },
        singleFamily: Object,
    },
    components: {
        BasicEntry,
    },
}
</script>

<style>

</style>