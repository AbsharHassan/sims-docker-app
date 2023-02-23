<template>
  <div>
    <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)"  :height="100" :width="100" background-color="rgb(203 213 225)" :opacity="loadingOpacity"/>
    <div class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]" :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`">
        <Sidebar/>
        <Header/>
        <section>
            <div class="pb-[20px]">
                <div class="bg-white/40 shadow-2xl m-10 mx-12 p-3 sm:p-5 border-t-8 border-t-sky-500">
                    <header class="text-center">
                        <div class=""> 
                            <h2 class="text-lg md:text-2xl font-bold uppercase mb-3 text-center">
                                Edit academic details of student with ID: <span class="text-blue-500 underline underline-offset-2"> {{$route.params.student_id}}</span>
                            </h2>
                        </div>
                        <div class="grad2 max-w-[40%] mx-auto"></div>
                        <p class="text-sm sm:text-base mb-4 mt-3">Edit academic details of the student or click 
                            <router-link :to="{name: 'Dashboard'}" class="text-black underline">here</router-link>
                            to go back.
                            </p>
                    </header>
                    <hr class="my-[20px]">
                    <div>
                        <div class="mt-10">
                            <div class="mt-10">
                                <div v-if="this.semesters">
                                    <div>
                                        <SemesterUpdate :semesterNumber="this.count" @entrySuccess="semesterMonitor()" :academicsObject="academicsObject" :key="this.semCount"/>                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Sidebar from '../../components/Sidebar.vue'
import Header from '../../components/Header.vue'
import Button from '../../components/Button.vue'
import SemesterUpdate from '../../components/SemesterUpdate.vue'
import Subject from '../../components/Subject.vue'
import { mapGetters, mapActions } from 'vuex'


export default {
    name: 'EditStudentAcademics',
    components: {
        Sidebar,
        Header,
        Button,
        SemesterUpdate,
        Subject,
        Loading
    },
    data() {
        return {
            academicsObject: null,
            semesters: null,
            student_id: null,
            count: null,
            semCount: 0,
            // formFields: {
            //     student_id: null,
            //     semester: null,
            //     subject_1: null,
            //     subject_2: null,
            //     subject_3: null,
            //     subject_4: null,
            //     subject_5: null,
            //     subject_6: null,
            //     subject_7: null,
            //     subject_8: null,
            //     subject_9: null,
            //     subject_10: null,
            //     subj_credit_1: null,
            //     subj_credit_2: null,
            //     subj_credit_3: null,
            //     subj_credit_4: null,
            //     subj_credit_5: null,
            //     subj_credit_6: null,
            //     subj_credit_7: null,
            //     subj_credit_8: null,
            //     subj_credit_9: null,
            //     subj_credit_10: null,
            //     subj_grade_1: null,
            //     subj_grade_2: null,
            //     subj_grade_3: null,
            //     subj_grade_4: null,
            //     subj_grade_5: null,
            //     subj_grade_6: null,
            //     subj_grade_7: null,
            //     subj_grade_8: null,
            //     subj_grade_9: null,
            //     subj_grade_10: null,
            // }
        }
    },
    methods: {
        ...mapActions(['getAcademicsCreatePage', 'getAllEntries', 'setFlashMessage', 'getSingleEntry']),
        async semesterMonitor() {
            if(this.count < this.semesters) {
                this.count++ 
                this.semCount++
                sessionStorage.setItem('STARTING_SEM', this.count)
            } else {
                await this.getAllEntries()
                this.setFlashMessage('Entry has been updated successfully')
            }
      }, 
    },
    computed: {
        ...mapGetters(['loadingStatus, flashMessage', 'singleAcademics', 'navWidth'])
    },
    async created() {
        this.loadingOpacity = 1
        await this.getSingleEntry(this.$route.params.student_id)
        this.academicsObject = this.singleAcademics
        console.log(this.academicsObject)
        this.semesters = sessionStorage.getItem('CURRENT_SEM')
        this.count = sessionStorage.getItem('STARTING_SEM')
    },
    destroyed() {
        this.loadingOpacity = 0.4
    }
}
</script>

<style>

</style>