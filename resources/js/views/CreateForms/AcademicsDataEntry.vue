<template>
  <div>
    <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)"  :height="100" :width="100" background-color="rgb(203 213 225)" :opacity="0.4"/>
    <div class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]" :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`">
        <Sidebar/>
        <Header/>
        <section>
            <div class="pb-[20px]">
                <div class="bg-white/40 shadow-2xl m-10 mx-12 p-3 sm:p-5 border-t-8 border-t-sky-500">
                    <header class="text-center">
                        <h3 class="text-lg sm:text-xl font-bold my-2">Enter Academic Data of Student with ID: <span class="text-blue-500 underline underline-offset-2"> {{ student_id }}  </span></h3>
                        <div class="grad2 max-w-[40%] mx-auto"></div>
                        <p class="text-sm sm:text-base mb-4 mt-3">Enter family details of the student or go <router-link :to="{name: 'Dashboard'}" class="text-black underline">back</router-link></p>
                    </header>
                    <hr class="my-[20px]">
                    <div>
                        <div class="mt-10">
                            <div class="mt-10">
                                <div v-if="this.semesters">
                                    <div>
                                        <Semester :semesterNumber="this.count" @entrySuccess="semesterMonitor()" />                  
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
import Semester from '../../components/Semester.vue'
import Subject from '../../components/Subject.vue'
import { mapGetters, mapActions } from 'vuex'


export default {
    name: 'AcademicsDataEntry',
    components: {
        Sidebar,
        Header,
        Button,
        Semester,
        Subject,
        Loading
    },
    data() {
        return {
            semesters: null,
            student_id: null,
            count: null,
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
        ...mapActions(['getAcademicsCreatePage', 'getAllEntries', 'setFlashMessage']),
        async semesterMonitor() {
            if(this.count < this.semesters) {
                this.count++ 
                sessionStorage.setItem('STARTING_SEM', this.count)
            } else {
                await this.getAllEntries()
                this.setFlashMessage('Entry has been created successfully')
            }
      }, 
    },
    computed: {
        ...mapGetters(['loadingStatus, flashMessage', 'navWidth'])
    },
    created() {
        this.semesters = sessionStorage.getItem('CURRENT_SEM')
        this.count = sessionStorage.getItem('STARTING_SEM')
        this.student_id = this.$route.params.student_id
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if(!(from.path === `/students/${from.params.student_id}/family/create`)) {
                vm.getAcademicsCreatePage(vm.$route.params.student_id)
            } 
        })
    }
}
</script>

<style>

</style>