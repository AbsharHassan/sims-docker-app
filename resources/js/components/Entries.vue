<template>
    <div>
        <div
            class="bg-slate-200 p-2 rounded-md sm:h-[100px] border border-slate-200 hover:border-2 hover:border-cyan-700 transition duration-500 flex justify-center items-center hover:shadow-2xl hover:-translate-y-1 hover:bg-slate-100"
            :class="!isLastEntry ? 'mb-5' : ''"
        >
            <div
                class="w-full sm:grid xl:grid-cols-7 lg:grid-cols-5 sm:grid-cols-4 gap-0 space-y-3 sm:space-y-0 h-[80%]"
            >
                <EntrySegment :value="entry.id" :idField="true" />
                <EntrySegment
                    title="Name"
                    :value="entry.first_name + ' ' + entry.last_name"
                    class="flex flex-col justify-center text-center sm:col-span-2"
                />
                <EntrySegment
                    title="Age"
                    :value="entry.age + ' years old'"
                    class="flex flex-col justify-center"
                />
                <EntrySegment
                    title="Degree"
                    :value="
                        entry.department + '-' + entry.degree + '-' + entry.syn
                    "
                    class="hidden lg:flex lg:flex-col lg:justify-center"
                />
                <EntrySegment
                    title="FSC"
                    :value="entry.fsc_marks"
                    class="hidden xl:flex xl:flex-col xl:justify-center"
                />
                <EntrySegment
                    title="Matric"
                    :value="entry.matric_marks"
                    class="hidden xl:flex xl:flex-col xl:justify-center"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import EntrySegment from "./EntrySegment.vue";

export default {
    name: "Entries",
    props: {
        entry: Object,
    },
    data() {
        return {
            isLastEntry: false,
        };
    },
    components: {
        EntrySegment,
    },
    computed: {
        ...mapGetters(["allEntries"]),
    },
    created() {
        if (
            this.entry.id ==
            this.allEntries[0][this.allEntries[0].length - 1].id
        ) {
            this.isLastEntry = true;
        }
    },
};
</script>

<style></style>
