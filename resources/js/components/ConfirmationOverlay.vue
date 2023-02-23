<template>
    <div
        class="fixed top-0 h-screen w-screen bg-black/50 z-50 flex justify-center items-center"
    >
        <div
            class="w-[300px] h-[150px] bg-white/70 mx-3 rounded-lg overflow-hidden"
        >
            <div class="h-[70%] text-sm flex flex-col">
                <div
                    class="basis-[15%] flex items-center justify-end pt-1 pr-1.5 text-lg"
                >
                    <button @click="closeConfirmation()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div
                    class="basis-[85%] flex justify-center items-center font-medium"
                >
                    {{ confirmationOverlayMessage }}
                </div>
            </div>
            <div class="flex h-[30%] overflow-hidden">
                <div class="basis-1/2">
                    <form @submit="onDeleteSubmit">
                        <!-- <Button text="Yes" @submit="onDeleteSubmit" class="w-full h-full rounded-none rounded-bl-lg bg-sky-500/70 hover:bg-sky-900" /> -->
                        <button
                            @submit="onDeleteSubmit"
                            class="bg-sky-600 text-center py-3 text-white font-bold transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center w-full h-full rounded-none rounded-bl bg-sky-500/70 hover:bg-sky-900"
                        >
                            Yes
                        </button>
                    </form>
                </div>
                <div class="basis-1/2">
                    <!-- <Button text="No" @click="deleteConfirmer(false), closeConfirmation()" class="w-full h-full rounded-none rounded-br-lg bg-slate-600/70 hover:bg-slate-800" /> -->
                    <button
                        @click="deleteConfirmer(false), closeConfirmation()"
                        class="text-center py-3 text-white font-bold transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center w-full h-full rounded-none rounded-br bg-slate-600/70 hover:bg-slate-800"
                    >
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Button from "./Button.vue";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "ConfirmationOverlay",
    components: {
        Button,
    },
    computed: {
        ...mapGetters(["confirmationOverlayMessage", "deleteTarget"]),
    },
    methods: {
        ...mapActions([
            "deleteConfirmer",
            "showConfirmationBox",
            "deleteSingleCourse",
            "deleteSigleStudent",
        ]),
        closeConfirmation() {
            this.showConfirmationBox({
                value: false,
                target: "",
            });
        },
        async onDeleteSubmit(e) {
            e.preventDefault();
            if (this.deleteTarget == "course") {
                await this.deleteSingleCourse(this.$route.params.course_id);
                this.closeConfirmation();
            } else if (this.deleteTarget == "student") {
                await this.deleteSigleStudent(this.$route.params.student_id);
                this.closeConfirmation();
            }
        },
    },
};
</script>

<style>
.confirmation-enter-from,
.confirmation-leave-to {
    opacity: 0;
    /* transform: scale(0); */
    transform: translateY(-300px);
}
.confirmation-enter-to {
    opacity: 1;
    /* transform: scale(1); */
    transform: translateY(0);
}
.confirmation-enter-active,
.confirmation-leave-active {
    transition: all 0.5s ease;
}
.confirmation-move {
    transition: all 0.5s ease;
}
</style>
