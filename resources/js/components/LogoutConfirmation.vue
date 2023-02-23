<template>
    <div
        class="fixed top-0 h-screen w-screen bg-black/50 z-50 flex justify-center items-center"
    >
        <div
            class="w-[300px] h-[150px] bg-white/90 mx-3 rounded overflow-hidden"
        >
            <div class="h-[70%] text-sm flex flex-col">
                <div
                    class="basis-[15%] flex items-center justify-end pt-1 pr-1.5 text-lg"
                >
                    <button @click="this.showLogout(false)">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div
                    class="basis-[85%] flex items-center text-center font-medium"
                >
                    {{ logoutMessage }}
                </div>
            </div>
            <div class="flex">
                <div class="basis-1/2">
                    <form @submit="onSubmit">
                        <!-- <Button
                            text="Yes"
                            @submit="onSubmit"
                            class="w-full h-full rounded-none rounded-bl bg-sky-500/70 hover:bg-sky-900"
                        /> -->
                        <button
                            class="bg-sky-600 text-center py-3 text-white font-bold transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center w-full h-full rounded-none rounded-bl bg-sky-500/70 hover:bg-sky-900"
                        >
                            Yes
                        </button>
                    </form>
                </div>
                <div class="basis-1/2">
                    <!-- <Button
                        text="No"
                        @click="this.showLogout(false)"
                        class="w-full h-full rounded-none rounded-br bg-slate-600/70 hover:bg-slate-800"
                    /> -->
                    <button
                        @click="this.showLogout(false)"
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
    name: "LogoutConfirmation",
    components: {
        Button,
    },
    computed: {
        ...mapGetters(["logoutMessage"]),
    },
    methods: {
        ...mapActions(["showLogout", "handleLogout"]),
        async onSubmit(event) {
            event.preventDefault();
            await this.handleLogout();
            this.showLogout(false);
        },
    },
};
</script>

<style>
.logoutConfirmation-enter-from,
.logoutConfirmation-leave-to {
    opacity: 0;
    transform: translateY(-300px);
}
.logoutConfirmation-enter-to {
    opacity: 1;
    transform: translateY(0);
}
.logoutConfirmation-enter-active,
.logoutConfirmation-leave-active {
    transition: all 0.5s ease;
}
.logoutConfirmation-move {
    transition: all 0.5s ease;
}
</style>
