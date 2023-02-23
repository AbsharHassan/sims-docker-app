<template>
  <div>
    <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)"  :height="100" :width="100" background-color="rgb(203 213 225)" :opacity="loadingOpacity"/>
    <div>
        <div>
            <h4 class="text-lg sm:text-xl font-bold my-2 underline underline-offset-4">Semester {{semesterNumber}}</h4>
            <div>
                <form @submit="onSubmit">
                    <transition-group name="subject" mode="out-in" appear>
                        <div v-for="number in 10" :key="number">
                            <div v-if="showObject[number]">
                                <SubjectUpdate :keyProp="number" @changeMonitor="updateData($event, (number))" key="number" @addSubject="addSubject()" :semesterFormFields="semesterArray" @removeSubject="removeSubject(number)"/>
                            </div>
                        </div>
                        <div v-if="numberSubjects < 10" id="slideButton" class="text-center sm:text-right mt-4" key="button">
                            <span @click="addSubject()" class="hover:bg-black transition duration-300 bg-sky-700 rounded-md py-1 text-white hover:cursor-pointer ">
                                <i class="bi bi-plus-lg text-xl mx-7"></i>
                            </span>
                        </div>
                        <div class="text-center mb-6 sm:mb-0 flex justify-center" key="submitter">
                            <Button text="Update Semester Entry" class="m-0 mt-6 py-3 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black h-12 w-full sm:max-w-[300px]" @submit="onSubmit">
                                <template #extraText v-if="loadingStatus">
                                    <span class="font-bold">
                                        Processing
                                    </span>
                                </template>
                                <template #spinnerIcon v-if="loadingStatus">
                                    <span>
                                        <i class="bi bi-arrow-repeat"></i>
                                    </span>  
                                </template>
                            </Button>
                        </div>
                    </transition-group>
                </form>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import SubjectUpdate from './SubjectUpdate.vue'
import Button from './Button.vue'
import { mapActions, mapGetters } from 'vuex'
import { ref } from '@vue/reactivity'

export default {
    name: 'Semester',
    components: {
        SubjectUpdate,
        Button,
        Loading
    },
    props: {
        semesterNumber: [Number, String],
        academicsObject: [Object, Array]
    },
    computed: {
        ...mapGetters(['allErrors', 'loadingStatus', 'singleAcademics']),
    },
    methods: {
        ...mapActions(['editStudentAcademics', 'getSingleEntry', 'setFlashMessage']),
        randomFunc() {
            console.log(this.formFields)
        },
        removeSubject(index) {
            this.showObject[index] = false
            this.formFields[`subject_${index}`] = null
            this.formFields[`subject_${index}_id`] = null
            this.formFields[`subj_credit_${index}`] = null
            this.formFields[`subj_grade_${index}`] = null
            this.semesterArray[`subject_${index}`] = null
            this.semesterArray[`subject_${index}_id`] = null
            this.semesterArray[`subj_credit_${index}`] = null
            this.semesterArray[`subj_grade_${index}`] = null
        },
        addSubject() {
            var minEmpty = 0
            for(let i=1;i<=10;i++) {
                if(!this.showObject[i]) {
                    minEmpty = i
                    break
                }
            }
            if(minEmpty) {
                this.showObject[minEmpty] = true
            } else {
                this.setFlashMessage('10 is the maximum number of subjects per semester')
            }
        },
        updateData(data, index) {
            this.formFields[`subject_${index}`] = data.subject
            this.formFields[`subject_${index}_id`] = data.id
            this.formFields[`subj_credit_${index}`] = data.credit
            this.formFields[`subj_grade_${index}`] = data.grade
        },
        entrySuccess() {
            this.$emit('entrySuccess')
        },
        async onSubmit(e) {
            e.preventDefault();
            await this.editStudentAcademics(this.formFields);
            if(Object.keys(this.allErrors).length == 0) {
                this.entrySuccess();
            }
        },
    },
    data() {
        return {
            showObject: {
                1: false,
                2: false,
                3: false,
                4: false,
                5: false,
                6: false,
                7: false,
                8: false,
                9: false,
                10: false,
            },
            formFields: {
                academic_id: null,
                student_id: null,
                semester: null,
                subject_1: null,
                subject_2: null,
                subject_3: null,
                subject_4: null,
                subject_5: null,
                subject_6: null,
                subject_7: null,
                subject_8: null,
                subject_9: null,
                subject_10: null,
                subject_1_id: null,
                subject_2_id: null,
                subject_3_id: null,
                subject_4_id: null,
                subject_5_id: null,
                subject_6_id: null,
                subject_7_id: null,
                subject_8_id: null,
                subject_9_id: null,
                subject_10_id: null,
                subj_credit_1: null,
                subj_credit_2: null,
                subj_credit_3: null,
                subj_credit_4: null,
                subj_credit_5: null,
                subj_credit_6: null,
                subj_credit_7: null,
                subj_credit_8: null,
                subj_credit_9: null,
                subj_credit_10: null,
                subj_grade_1: null,
                subj_grade_2: null,
                subj_grade_3: null,
                subj_grade_4: null,
                subj_grade_5: null,
                subj_grade_6: null,
                subj_grade_7: null,
                subj_grade_8: null,
                subj_grade_9: null,
                subj_grade_10: null,
            },
            numberSubjects: null,
            semesterArray: [],
            count: 0,
            loadingOpacity: 1,
        }
    },
    watch: {
        numberSubjects(newNumberSubjects, oldNumberSubjects) {
            for(const key in this.showObject) {
                if(this.showObject.hasOwnProperty(key)) {
                    if(key <= newNumberSubjects) {
                        this.showObject[key] = true
                    }
                }
            }
        }
    },
    created() {
        this.semesterArray = []
        this.loadingOpacity = 1
        // await this.getSingleEntry(this.$route.params.student_id)
        
        // this.semesterArray = this.singleAcademics[this.semesterNumber - 1]
        this.semesterArray = this.academicsObject[this.semesterNumber - 1]
        for(let x = 1; x <= 10; x++) {
            if(this.semesterArray[`subject_${x}`]) {
                this.count = this.count + 1
            }
        }
        this.show = 0;
        this.numberSubjects = this.count;
        for (const key in this.formFields) {
            if(this.formFields.hasOwnProperty(key)) {
                this.formFields[key] = this.semesterArray[key]
            }
        }
    },
    destroyed() {
        this.loadingOpacity = 0.4
    }
}
</script>

<style>

.subject-enter-from {
    opacity: 0;
    transform: translateY(-300px);
}
.subject-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.subject-enter-active {
    transition: all 0.25s ease;
}
.subject-move {
    transition: all 0.25s ease;
}

</style>