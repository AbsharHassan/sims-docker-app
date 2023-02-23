<template>
    <div>
        <div
            class="bg-slate-100/60 rounded-md mt-6 px-3 border shadow-lg hover:shadow-2xl hover:border-blue-300 transition duration-500"
        >
            <div
                class="flex justify-between items-center sm:text-base font-bold mb-1 mt-4"
            >
                <div>Subject {{ someKey }}</div>
                <div class="flex items-center justify-end pt-1 pr-1.5 text-lg">
                    <span
                        class="hover: cursor-pointer"
                        @click="removeSubject()"
                    >
                        <i class="bi bi-x-lg"></i>
                    </span>
                </div>
            </div>
            <hr class="w-[30%] text-black" />
            <div class="mt-4 md:flex">
                <div class="basis-[40%] md:pr-3 mb-6">
                    <!-- <label class="inline-block text-md mb-2 font-medium">Title</label>
            <input type="text" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.subject" @input="changeMonitor()"/> -->
                    <BaseInput
                        name="Title"
                        class="h-[45px]"
                        v-model="this.formFields.subject"
                        @change="changeMonitor()"
                    />
                </div>
                <div class="basis-[20%] md:pr-3 mb-6">
                    <!-- <label class="inline-block text-md mb-2 font-medium">Subject ID</label>
            <input type="text" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.id" @input="changeMonitor()"/> -->
                    <BaseInput
                        name="Subject ID"
                        class="h-[45px]"
                        v-model="this.formFields.id"
                        @input="changeMonitor()"
                    />
                </div>
                <div class="basis-[20%] md:pr-3 mb-6">
                    <!-- <label class="inline-block text-md mb-2 font-medium">Credit Hours</label>
            <input type="number" min="1" max="8" step="1" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" v-model="this.formFields.credit" @input="changeMonitor()"/> -->
                    <BaseInput
                        name="Credit Hours"
                        class="h-[45px]"
                        v-model="this.formFields.credit"
                        @input="changeMonitor()"
                    />
                </div>
                <div class="basis-[20%] mb-6">
                    <!-- <label class="inline-block text-md mb-2 font-medium">Grade Obtained</label>
            <select v-model="formFields.grade" id="grade" class="bg-slate-200 border border-slate-400 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 h-[40px]" @change="changeMonitor()">
              <option value="A">A</option>
              <option value="B+">B+</option>
              <option value="B">B</option>
              <option value="C+">C+</option>
              <option value="C">C</option>
              <option value="D+">D+</option>
              <option value="D">D</option>
              <option value="F">F</option>
            </select> -->
                    <SelectInput
                        name="Grade"
                        v-model="formFields.grade"
                        :optionBag="this.gradeBag"
                        class="h-[45px]"
                        @change="changeMonitor()"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SelectInput from "./SelectInput.vue";
import BaseInput from "./BaseInput.vue";

export default {
    name: "Subject",
    components: {
        BaseInput,
        SelectInput,
    },
    props: {
        keyProp: Number,
        semesterNumber: Number,
        studentID: String,
    },
    methods: {
        changeMonitor() {
            this.$emit("changeMonitor", this.formFields);
            // console.log(this.formFields)
        },
        addSubject() {
            this.$emit("addSubject");
        },
        removeSubject() {
            this.$emit("removeSubject");
        },
    },
    data() {
        return {
            someKey: null,
            formFields: {
                subject: null,
                id: null,
                credit: null,
                grade: null,
            },
            gradeBag: {
                A: "A",
                "B+": "B+",
                B: "B",
                "C+": "C+",
                C: "C",
                "D+": "D+",
                D: "D",
                F: "F",
            },
        };
    },
    created() {
        this.someKey = this.$props.keyProp;
    },
};
</script>

<style></style>
