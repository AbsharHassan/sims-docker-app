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
                            <div class="sm:flex items-baseline">
                                <h2
                                    class="sm:pl-14 basis-[94%] text-xl md:text-2xl font-bold uppercase mb-3"
                                >
                                    Edit Course with ID:
                                    <span
                                        class="text-blue-500 underline underline-offset-2"
                                    >
                                        {{ $route.params.course_id }}</span
                                    >
                                </h2>
                                <div
                                    class="hover:underline underline-offset-2 sm:basis-[6%] w-[100px] mx-auto sm:w-auto"
                                >
                                    <button
                                        @click="
                                            showConfirmationBox(
                                                deleteSetterObject
                                            )
                                        "
                                        class="hover:underline underline-offset-2"
                                    >
                                        <div
                                            class="flex justify-center items-baseline"
                                        >
                                            <div
                                                class="font-medium mr-2 sm:mr-0"
                                            >
                                                Delete
                                            </div>
                                            <div>
                                                <i class="bi bi-trash-fill"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="grad2 max-w-[40%] mx-auto"></div>
                            <p class="text-sm sm:text-base mb-4 mt-3">
                                Edit details of the course or click
                                <router-link
                                    :to="{
                                        name: 'SingleCourse',
                                        params: {
                                            course_id: $route.params.course_id,
                                        },
                                    }"
                                    class="text-black underline"
                                    >here</router-link
                                >
                                to go back.
                            </p>
                        </header>
                        <hr class="my-[20px]" />
                        <transition name="form" appear>
                            <form
                                enctype="multipart/form-data"
                                class="bg-slate-100/75 px-3 py-2 border rounded shadow-lg hover:shadow-2xl hover:border-blue-300 transition duration-500 pb-6"
                                @submit="onUpdateSubmit"
                            >
                                <div class="sm:flex">
                                    <div class="mb-6 basis-1/2 sm:pr-3">
                                        <BaseInput
                                            v-model="formFieldsCourse.course_id"
                                            name="Course ID"
                                            type="number"
                                            objKey="course_id"
                                            needsReplace="id"
                                            replacer="ID"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="
                                                formFieldsCourse.course_code
                                            "
                                            name="Course Code"
                                            type="text"
                                            objKey="course_code"
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
                                            v-model="
                                                formFieldsCourse.course_name
                                            "
                                            name="Course Name"
                                            type="text"
                                            objKey="course_name"
                                            class="h-[45px]"
                                        >
                                            <span class="text-red-600">
                                                *
                                            </span>
                                        </BaseInput>
                                    </div>
                                    <div class="mb-6 basis-1/2 sm:pl-3">
                                        <BaseInput
                                            v-model="formFieldsCourseData.marks"
                                            name="Course Marks (CSV)"
                                            type="text"
                                            objKey="marks"
                                            class="h-[45px] text-center"
                                        >
                                        </BaseInput>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label
                                        for="reason"
                                        class="inline-block text-md mb-1 font-medium"
                                        >Course Description</label
                                    >
                                    <textarea
                                        class="input-bg border border-slate-300 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[150px]"
                                        v-model="
                                            formFieldsCourse.course_description
                                        "
                                    ></textarea>
                                </div>
                                <div
                                    class="mt-[20px] sm:flex sm:flex-row-reverse justify-between items-baseline"
                                >
                                    <div
                                        class="text-center mb-6 sm:mb-0 flex justify-center"
                                    >
                                        <Button
                                            text="Update Entry"
                                            class="m-0 py-3 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black h-12 w-full sm:w-32"
                                            @submit="onUpdateSubmit"
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
                                            :to="{
                                                name: 'SingleCourse',
                                                params: {
                                                    course_id:
                                                        $route.params.course_id,
                                                },
                                            }"
                                            class="text-black hover:underline underline-offset-2"
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
import { mapActions, mapGetters } from "vuex";

export default {
    name: "CreateEntry",
    components: {
        Sidebar,
        Header,
        Button,
        BaseInput,
        Loading,
    },
    methods: {
        ...mapActions([
            "getSingleCourse",
            "editSingleCourse",
            "setLoadingStatus",
            "addCourseMarks",
            "showConfirmationBox",
        ]),
        onFileChange(event) {
            this.formFieldsCourseData.selectedFile = event.target.files[0];
            console.log(this.formFieldsCourseData.selectedFile);
        },
        async onUpdateSubmit(e) {
            this.updatePayload.formFields = this.formFieldsCourse;
            this.updatePayload.id = this.$route.params.course_id;
            this.formFieldsCourseData.course_id =
                this.formFieldsCourse.course_id;
            e.preventDefault();
            await this.editSingleCourse(this.updatePayload);
            if (Object.keys(this.allErrors).length == 0) {
                if (this.formFieldsCourseData.marks) {
                    this.setLoadingStatus(true);
                    await this.addCourseMarks(this.formFieldsCourseData);
                    if (Object.keys(this.allErrors).length == 0) {
                        this.$router.push({
                            name: "SingleCourse",
                            params: {
                                course_id: this.formFieldsCourse.course_id,
                            },
                        });
                    }
                } else {
                    this.$router.push({
                        name: "SingleCourse",
                        params: { course_id: this.formFieldsCourse.course_id },
                    });
                }
            }
        },
        async onDeleteSubmit(e) {
            e.preventDefault();
            await this.deleteSingleCourse(this.$route.params.course_id);
        },
        errorChecker(fieldName) {
            return this.allErrors.hasOwnProperty(fieldName);
        },
    },
    computed: {
        ...mapGetters([
            "singleCourse",
            "allErrors",
            "loadingStatus",
            "navWidth",
        ]),
    },
    data() {
        return {
            deleteSetterObject: {
                value: true,
                target: "course",
            },
            target: null,
            formFieldsCourse: {
                course_id: null,
                course_code: null,
                course_name: null,
                course_description: null,
            },
            formFieldsCourseData: {
                course_id: null,
                selectedFile: "",
                marks: null,
            },
            updatePayload: {
                formFields: null,
                id: null,
            },
        };
    },
    async created() {
        this.target = "course";
        await this.getSingleCourse(this.$route.params.course_id);
        this.formFieldsCourse.course_id = this.singleCourse.course_id;
        this.formFieldsCourse.course_code = this.singleCourse.course_code;
        this.formFieldsCourse.course_name = this.singleCourse.course_name;
        this.formFieldsCourse.course_description =
            this.singleCourse.course_description;
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
