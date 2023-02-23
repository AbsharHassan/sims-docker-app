<template>
        <div class="absolute inset-0 z-30">
            <div class="bg-black/50 text-white h-full my-auto overflow-auto rounded">
                <div>
                    <div class="sticky top-0 left-0 h-14 w-full z-40">
                        <button @click="closeSemDetails()" class="float-right text-4xl mr-4 mt-3 sticky top-0">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <div class="h-full overflow-clip sticky top-0 left-0" >
                        <div class="text-black flex">
                            <div class="pt-1 flex flex-wrap justify-center">
                                <div v-for="number in 10" :key="number">
                                    <div v-if="academicsData[`subject_${number}`]" class="mx-2">
                                        <SingleSubjDetails :subjectTitle="academicsData[`subject_${number}`]" :subjectCredit="academicsData[`subj_credit_${number}`]" :subjectGrade="academicsData[`subj_grade_${number}`]"
                                        :subjectId="academicsData[`subject_${number}_id`]"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import SingleSubjDetails from './SingleSubjDetails.vue'
import { mapActions } from 'vuex'

export default {
    name: 'SemesterDetails',
    props: {
        academicsData: Object
    },
    components: {
        SingleSubjDetails
    },
    methods: {
        ...mapActions(['getSubjectHistogram']),
        closeSemDetails() {
            this.$emit('closeSemDetails')
        },
    },
}
</script>

<style>

</style>