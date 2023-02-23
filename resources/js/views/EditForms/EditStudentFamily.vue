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
                        <div class=""> 
                            <h2 class="text-lg md:text-2xl font-bold uppercase mb-3 text-center">
                                Edit family details of student with ID: <span class="text-blue-500 underline underline-offset-2"> {{$route.params.student_id}}</span>
                            </h2>
                            <!-- <div class="hover:underline underline-offset-2 sm:basis-[6%] w-[100px] mx-auto sm:w-auto">
                                <button @click="showConfirmationBox(deleteSetterObject)" class="hover:underline underline-offset-2">
                                    <div class="flex justify-center items-baseline">
                                        <div class="font-medium mr-2 sm:mr-0">
                                            Delete 
                                        </div>
                                        <div>
                                            <i class="bi bi-trash-fill"></i>
                                        </div>
                                    </div>
                                </button>
                            </div> -->
                        </div>
                        <div class="grad2 max-w-[40%] mx-auto"></div>
                        <p class="text-sm sm:text-base mb-4 mt-3">Edit family details of the student or click 
                            <router-link :to="{name: 'Dashboard'}" class="text-black underline">here</router-link>
                            to go back.
                            </p>
                    </header>
                    <!-- <header class="text-center">
                        <h3 class="text-lg sm:text-xl font-bold my-2">Enter Family Data of Student with ID: <span class="text-blue-500 underline underline-offset-2"> {{ student_id }}  </span></h3>
                        <div class="grad2 max-w-[40%] mx-auto"></div>
                        <p class="text-sm sm:text-base mb-4 mt-3">Enter family details of the student or go <router-link :to="{name: 'Dashboard'}" class="text-black underline">back</router-link></p>
                    </header> -->
                    <hr class="my-[20px]">
                    <transition name="form" appear>
                        <form @submit="onSubmit" class="bg-slate-100/75 px-3 py-2 border rounded shadow-lg hover:shadow-2xl hover:border-blue-300 transition duration-500 pb-6">
                            <div class="sm:text-lg font-medium mb-[20px] underline underline-offset-4">Family Details</div>
                            <div class="sm:flex sm:h-[100px]">
                                <div class="mb-6 basis-1/2 sm:pr-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Father's Name" type="text" v-model="formFields.father_name" objKey="father_name" needsReplace="The father name field" replacer="Father's name">
                                        <span class="text-red-600">
                                            *
                                        </span>
                                    </BaseInput>
                                </div>
                                <div class="mb-6 basis-1/2 sm:pl-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Father's Occupation" type="text" v-model="formFields.father_occupation" objKey="father_occupation" needsReplace="The father occupation field" replacer="Father's occupation">
                                        <span class="text-red-600">
                                            *
                                        </span>
                                    </BaseInput>
                                </div>
                            </div>
                            <div class="sm:flex sm:h-[100px]">
                                <div class="mb-7 basis-1/2 sm:pr-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Mother's Name" type="text" v-model="formFields.mother_name" objKey="mother_name" needsReplace="The mother name field" replacer="Mother's name"/>
                                </div>
                                <div class="mb-7 basis-1/2 sm:pl-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Mother's Occupation" type="text" v-model="formFields.mother_occupation" objKey="mother_occupation" needsReplace="The mother occupation field" replacer="Mother's occupation"/>
                                </div>
                            </div>
                            <div class="sm:max-w-xs sm:mx-auto sm:text-center h-[80px]">
                                <BaseInput name="Number of Siblings" type="text" v-model="formFields.number_siblings" objKey="number_siblings" needsReplace="number siblings" replacer="number of siblings"/>
                            </div>
                            <hr class="mt-[30px] mb-[10px]">
                            <div class="sm:text-lg font-medium mb-[20px] underline underline-offset-4">Contact Details</div>
                            <div class="sm:flex sm:h-[100px]">
                                <div class="mb-6 basis-1/2 sm:pr-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Father's Phone Number" type="number" v-model="formFields.father_phone" objKey="father_phone" needsReplace="The father phone field" replacer="Father's phone number"/>
                                </div>
                                <div class="mb-6 basis-1/2 sm:pl-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Mother's Phone Number" type="number" v-model="formFields.mother_phone" objKey="mother_phone" needsReplace="The mother phone field" replacer="Mother's phone number"/>
                                </div>
                            </div>
                            <div class="sm:flex sm:h-[100px]">
                                <div class="mb-6 basis-1/2 sm:pr-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Home Phone Number" type="number" v-model="formFields.home_phone" objKey="home_phone" needsReplace="The home phone field" replacer="Home's phone number"/>
                                </div>
                                <div class="mb-6 basis-1/2 sm:pl-3 h-[75px] sm:h-auto">
                                    <BaseInput name="Family Address" type="number" v-model="formFields.address" objKey="address"/>
                                </div>
                            </div>
                            <div class="mt-[20px] sm:flex sm:flex-row-reverse justify-between items-baseline">
                                <div class="text-center mb-6 sm:mb-0 flex justify-center">
                                    <Button text="Update Entry" class="m-0 py-3 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black h-12 w-full sm:w-32" @submit="onSubmit">
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
                                <div class="text-center flex justify-center items-center">
                                    <a class="hover:cursor-pointer" @click="$router.go(-1)" >Back</a>
                                </div> 
                            </div>                            
                        </form>
                    </transition>
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
import BaseInput from '../../components/BaseInput.vue'
import { mapActions, mapGetters } from 'vuex'

export default {
    name: 'EditStudentFamily',
    components: {
        Sidebar,
        Header,
        Button,
        BaseInput,
        Loading
    },
    methods: {
        ...mapActions(['getSingleEntry', 'getFamilyCreatePage', 'editStudentFamilyEntry']),
        async onSubmit(e) {
            this.formFields.student_id = this.$route.params.student_id;
            e.preventDefault();
            await this.editStudentFamilyEntry(this.formFields);
            if(Object.keys(this.allErrors).length == 0) {
                this.$router.push({name: 'EditStudentAcademics', params: {student_id: this.$route.params.student_id}})
            }
        },
        errorChecker(fieldName) {
            return (this.allErrors.hasOwnProperty(fieldName))
        }
    },
    computed: {
        ...mapGetters(['allErrors', 'loadingStatus', 'singleFamily', 'navWidth']),
    },
    data() {
        return {
            deleteSetterObject: {
                value: true,
                target: 'student'
            },
            formFields:{
                student_id: null,
                father_name: null,
                father_occupation: null,
                mother_name: null,
                home_phone: null,
                father_phone: null,
                mother_phone: null,
                address: null,
                mother_occupation: null,
                number_siblings: null,
            },
            student_id: null,
            current_sem: null
        }
    },
    async created() {
        await this.getSingleEntry(this.$route.params.student_id)
        for(const key in this.formFields) {
            if(this.formFields.hasOwnProperty(key)) {
                this.formFields[key] = this.singleFamily[key]
            }
        } 
    }
}
</script>

<style>

</style>