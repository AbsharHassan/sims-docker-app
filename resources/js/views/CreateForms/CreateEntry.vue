<template>
    <div>
        <Loading
            v-model:active="loadingStatus"
            loader="bars"
            color="rgb(2 132 199 / 0.75)"
            :height="100"
            :width="100"
            background-color="rgb(203 213 225)"
            :opacity="0.4"
        />
        <div
            class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]"
            :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`"
        >
            <Sidebar />
            <Header />
            <section>
                <div class="pb-[50px]">
                    <div
                        class="bg-white/40 shadow-2xl m-10 mx-12 p-3 sm:p-5 border-t-8 border-t-sky-500"
                    >
                        <header class="text-center">
                            <h2
                                class="text-xl md:text-2xl font-bold uppercase mb-3"
                            >
                                Create an Entry
                            </h2>
                            <div class="grad2 max-w-[40%] mx-auto"></div>
                            <!-- <h3 class="text-lg sm:text-xl font-bold my-2">Student Bio Data</h3> -->
                            <p class="text-sm sm:text-base mb-4 mt-3">
                                Enter details of the student or go
                                <router-link
                                    :to="{ name: 'Dashboard' }"
                                    class="text-black underline"
                                    >back</router-link
                                >
                            </p>
                        </header>
                        <hr class="my-[20px]" />
                        <transition name="form" appear>
                            <form
                                enctype="multipart/form-data"
                                class="bg-slate-100/75 px-3 py-2 border rounded shadow-lg hover:shadow-2xl hover:border-blue-300 transition duration-500 pb-6"
                                @submit="onSubmit"
                            >
                                <div class="sm:flex">
                                    <div class="mb-6 basis-1/2 sm:pr-3">
                                        <BaseInput
                                            v-model="formFields.first_name"
                                            name="First Name"
                                            type="text"
                                            objKey="first_name"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="formFields.last_name"
                                            name="Last Name"
                                            type="text"
                                            objKey="last_name"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                </div>
                                <div class="sm:flex">
                                    <div class="mb-6 basis-1/2 sm:pr-3">
                                        <BaseInput
                                            v-model="formFields.dob"
                                            name="Date of Birth"
                                            type="date"
                                            objKey="dob"
                                            needsReplace="dob"
                                            replacer="date of birth"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="formFields.joining_date"
                                            name="Joining Date"
                                            type="date"
                                            objKey="joining_date"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                </div>
                                <div class="sm:flex">
                                    <div class="mb-6 basis-1/2 sm:pr-3">
                                        <BaseInput
                                            v-model="formFields.id"
                                            name="Registration Number"
                                            type="text"
                                            objKey="id"
                                            needsReplace="id"
                                            replacer="registration number"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="formFields.phone_number"
                                            name="Phone Number"
                                            type="text"
                                            objKey="phone_number"
                                            class="h-[45px]"
                                        />
                                    </div>
                                </div>
                                <div class="sm:flex">
                                    <div class="mb-6 basis-1/2 sm:pr-3">
                                        <SelectInput
                                            name="Gender"
                                            v-model="formFields.gender"
                                            objKey="gender"
                                            :optionBag="this.gender"
                                        />
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="formFields.img"
                                            name="Upload Student Portrait"
                                            type="text"
                                            objKey="img"
                                            needsReplace="img field"
                                            replacer="student portrait"
                                            class="h-[45px]"
                                        />
                                    </div>
                                </div>
                                <div class="sm:flex">
                                    <div
                                        class="mb-6 basis-1/2 sm:mr-6 border-y border-y-1 pb-3"
                                    >
                                        <div
                                            class="mt-3 mb-4 text-base sm:text-sm md:text-base font-medium text-center underline underline-offset-4 sm:whitespace-nowrap overflow-x-hidden"
                                        >
                                            Higher Secondary School Certificate
                                        </div>
                                        <div class="lg:flex">
                                            <div class="basis-[40%]">
                                                <label
                                                    for="fsc_marks"
                                                    class="inline-block text-md mb-1 font-medium"
                                                >
                                                    Marks
                                                    <span class="text-red-600">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="flex items-stretch">
                                                    <div
                                                        class="basis-[90%] h-[45px]"
                                                    >
                                                        <input
                                                            type="number"
                                                            min="100"
                                                            max="1100"
                                                            class="input-bg border border-blue-200 border-y-slate-300 border-l-slate-300 rounded-l p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[45px]"
                                                            v-model="
                                                                formFields.fsc_marks
                                                            "
                                                            :class="
                                                                errorChecker(
                                                                    'fsc_marks'
                                                                )
                                                                    ? 'border-y-red-600 border-l-red-600'
                                                                    : ''
                                                            "
                                                        />
                                                    </div>
                                                    <div
                                                        class="basis-[10%] self-stretch h-[45px]"
                                                    >
                                                        <div
                                                            class="input-bg border border-blue-200 border-y-slate-300 border-r-slate-300 rounded-r px-2 w-full h-full"
                                                            :class="
                                                                errorChecker(
                                                                    'fsc_marks'
                                                                )
                                                                    ? 'border-y-red-600 border-r-red-600'
                                                                    : ''
                                                            "
                                                        >
                                                            <div
                                                                class="flex items-center justify-center text-sm h-full text-gray-500"
                                                            >
                                                                /1100
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    v-if="
                                                        allErrors['fsc_marks']
                                                    "
                                                    class="text-sm text-red-600 sm:mb-2"
                                                >
                                                    Required.
                                                </div>
                                            </div>
                                            <div
                                                class="basis-[60%] lg:pl-2 lg:flex"
                                            >
                                                <div class="basis-1/2">
                                                    <BaseInput
                                                        v-model="
                                                            formFields.fsc_year
                                                        "
                                                        name="Passing Year"
                                                        type="number"
                                                        min="1900"
                                                        max="2099"
                                                        step="1"
                                                        objKey="fsc_year"
                                                        needsReplace="The fsc year field is required."
                                                        replacer="Required."
                                                        :noWrapProp="true"
                                                        class="h-[45px]"
                                                    >
                                                        <span
                                                            class="text-red-600"
                                                        >
                                                            *
                                                        </span>
                                                    </BaseInput>
                                                </div>
                                                <div class="basis-1/2 lg:pl-2">
                                                    <BaseInput
                                                        v-model="
                                                            formFields.fsc_div
                                                        "
                                                        name="Division"
                                                        type="number"
                                                        min="1"
                                                        max="3"
                                                        step="1"
                                                        objKey="fsc_div"
                                                        needsReplace="The fsc div field is required."
                                                        replacer="Required."
                                                        class="h-[45px]"
                                                    >
                                                        <span
                                                            class="text-red-600"
                                                        >
                                                            *
                                                        </span>
                                                    </BaseInput>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mb-6 basis-1/2 border-y border-y-1 pb-3"
                                    >
                                        <div
                                            class="mt-3 mb-4 text-base sm:text-sm md:text-base font-medium text-center underline underline-offset-4 sm:whitespace-nowrap overflow-x-hidden"
                                        >
                                            Secondary School Certificate
                                        </div>
                                        <div class="lg:flex">
                                            <div class="basis-[40%]">
                                                <label
                                                    for="matric"
                                                    class="inline-block text-md mb-1 font-medium"
                                                >
                                                    Marks
                                                    <span class="text-red-600">
                                                        *
                                                    </span>
                                                </label>
                                                <div class="flex items-stretch">
                                                    <div
                                                        class="basis-[90%] h-[45px]"
                                                    >
                                                        <input
                                                            type="number"
                                                            min="100"
                                                            max="1100"
                                                            class="input-bg border border-blue-200 border-y-slate-300 border-l-slate-300 rounded-l p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[45px]"
                                                            v-model="
                                                                formFields.matric_marks
                                                            "
                                                            :class="
                                                                errorChecker(
                                                                    'matric_marks'
                                                                )
                                                                    ? 'border-y-red-600 border-l-red-600'
                                                                    : ''
                                                            "
                                                        />
                                                    </div>
                                                    <div
                                                        class="basis-[10%] self-stretch h-[45px]"
                                                    >
                                                        <div
                                                            class="input-bg border border-blue-200 border-y-slate-300 border-r-slate-300 rounded-r px-2 w-full h-full"
                                                            :class="
                                                                errorChecker(
                                                                    'matric_marks'
                                                                )
                                                                    ? 'border-y-red-600 border-r-red-600'
                                                                    : ''
                                                            "
                                                        >
                                                            <div
                                                                class="flex items-center justify-center text-sm h-full text-gray-500"
                                                            >
                                                                /1100
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    v-if="
                                                        allErrors[
                                                            'matric_marks'
                                                        ]
                                                    "
                                                    class="text-sm text-red-600 sm:mb-2"
                                                >
                                                    Required.
                                                </div>
                                            </div>
                                            <div
                                                class="basis-[60%] lg:pl-2 lg:flex"
                                            >
                                                <div class="basis-1/2">
                                                    <BaseInput
                                                        v-model="
                                                            formFields.matric_year
                                                        "
                                                        name="Passing Year"
                                                        type="number"
                                                        min="1900"
                                                        max="2099"
                                                        step="1"
                                                        objKey="matric_year"
                                                        needsReplace="The matric year field is required."
                                                        replacer="Required."
                                                        :noWrapProp="true"
                                                        class="h-[45px]"
                                                    >
                                                        <span
                                                            class="text-red-600"
                                                        >
                                                            *
                                                        </span>
                                                    </BaseInput>
                                                </div>
                                                <div class="basis-1/2 lg:pl-2">
                                                    <BaseInput
                                                        v-model="
                                                            formFields.matric_div
                                                        "
                                                        name="Division"
                                                        type="number"
                                                        min="1"
                                                        max="3"
                                                        step="1"
                                                        objKey="matric_div"
                                                        needsReplace="The matric div field is required."
                                                        replacer="Required."
                                                        class="h-[45px]"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="sm:flex">
                                        <div class="basis-1/4 sm:pr-3 mb-6">
                                            <BaseInput
                                                v-model="formFields.degree"
                                                name="Degree"
                                                type="text"
                                                objKey="degree"
                                                class="h-[45px]"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </BaseInput>
                                        </div>
                                        <div class="basis-1/4 sm:pr-3 mb-6">
                                            <SelectInput
                                                name="Department"
                                                v-model="formFields.department"
                                                objKey="department"
                                                :optionBag="this.department"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </SelectInput>
                                        </div>
                                        <div class="basis-1/4 sm:pr-3 mb-6">
                                            <SelectInput
                                                name="Syndicate"
                                                v-model="formFields.syn"
                                                objKey="syn"
                                                :optionBag="this.syndicate"
                                                needsReplace="syn"
                                                replacer="syndicate"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </SelectInput>
                                        </div>
                                        <div class="basis-1/4 mb-6">
                                            <BaseInput
                                                v-model="formFields.current_sem"
                                                name="Semester"
                                                type="number"
                                                min="1"
                                                max="8"
                                                step="1"
                                                objKey="current_sem"
                                                needsReplace="current sem"
                                                replacer="semester"
                                                class="h-[45px]"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </BaseInput>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label
                                        for="reason"
                                        class="inline-block text-md mb-1 font-medium"
                                        >Comments/Reasons for Withdrawal</label
                                    >
                                    <textarea
                                        class="input-bg border border-slate-300 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[150px]"
                                        v-model="formFields.reason"
                                    ></textarea>
                                </div>
                                <div
                                    class="mt-[20px] sm:flex sm:flex-row-reverse justify-between items-baseline"
                                >
                                    <div
                                        class="text-center mb-6 sm:mb-0 flex justify-center"
                                    >
                                        <Button
                                            text="Create Entry"
                                            class="m-0 py-3 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black h-12 w-full sm:w-32"
                                            @submit="onSubmit"
                                        >
                                            <template
                                                #extraText
                                                v-if="loadingStatus"
                                            >
                                                <span class="font-bold">
                                                    Processing
                                                </span>
                                            </template>
                                            <template
                                                #spinnerIcon
                                                v-if="loadingStatus"
                                            >
                                                <span>
                                                    <i
                                                        class="bi bi-arrow-repeat"
                                                    ></i>
                                                </span>
                                            </template>
                                        </Button>
                                    </div>
                                    <div
                                        class="text-center flex justify-center items-center"
                                    >
                                        <router-link
                                            :to="{ name: 'Dashboard' }"
                                            class="text-black"
                                            >Back</router-link
                                        >
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
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Sidebar from "../../components/Sidebar.vue";
import Header from "../../components/Header.vue";
import Button from "../../components/Button.vue";
import BaseInput from "../../components/BaseInput.vue";
import SelectInput from "../../components/SelectInput.vue";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "CreateEntry",
    components: {
        Sidebar,
        Header,
        Button,
        BaseInput,
        SelectInput,
        Loading,
    },
    methods: {
        ...mapActions(["addEntryStudent"]),
        async onSubmit(e) {
            e.preventDefault();
            await this.addEntryStudent(this.formFields);
            if (Object.keys(this.allErrors).length == 0) {
                localStorage.current_sem = this.formFields.current_sem;
                sessionStorage.setItem(
                    "CURRENT_SEM",
                    this.formFields.current_sem
                );
                sessionStorage.setItem("STARTING_SEM", 1);
                this.$router.push({
                    name: "FamilyDataEntry",
                    params: { student_id: this.formFields.id },
                });
            }
        },
        errorChecker(fieldName) {
            return this.allErrors.hasOwnProperty(fieldName);
        },
    },
    computed: {
        ...mapGetters(["allErrors", "loadingStatus", "navWidth"]),
    },
    data() {
        return {
            loading: true,
            syndicate: {
                A: "syndicate A",
                B: "syndicate B",
                C: "syndicate C",
            },
            department: {
                EE: "Electrical Engineering",
                CE: "Computer and Software Engineering",
                ME: "Mechanical Engineering",
                MTS: "Mechatronics Engineering",
            },
            gender: {
                M: "Male",
                F: "Female",
            },
            formFields: {
                id: null,
                first_name: null,
                last_name: null,
                dob: null,
                joining_date: null,
                phone_number: null,
                gender: null,
                fsc_marks: null,
                fsc_year: null,
                fsc_div: null,
                matric_marks: null,
                matric_year: null,
                matric_div: null,
                current_sem: null,
                department: null,
                degree: null,
                syn: null,
                reason: null,
                img: null,
            },
        };
    },
};
</script>

<style>
.form-enter-from {
    opacity: 0;
    transform: translateY(-300px);
}
.form-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.form-enter-active {
    transition: all 0.5s ease-out;
}
.form-move {
    transition: all 0.5s ease-out;
}
.field {
    border: 1px solid rgb(203 213 225);
}
.field-error {
    border: 1px solid rgb(220 38 38);
}
</style>
