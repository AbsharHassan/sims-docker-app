<template>
    <div>
        <div class="overflow-x-clip h-[100vh]">
            <router-view v-slot="{ Component, route }">
                <transition :name="route.meta.transitionName" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </div>
        <transition name="flash" appear>
            <FlashNotification v-if="flashMessage" />
        </transition>
        <transition name="confirmation" appear>
            <ConfirmationOverlay v-if="showConfirmationBox" />
        </transition>
        <transition name="logoutConfirmation" appear>
            <LogoutConfirmation v-if="showLogoutBox" />
        </transition>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import FlashNotification from "./components/FlashNotification.vue";
import ConfirmationOverlay from "./components/ConfirmationOverlay.vue";
import LogoutConfirmation from "./components/LogoutConfirmation.vue";

export default {
    name: "App",
    components: {
        FlashNotification,
        ConfirmationOverlay,
        LogoutConfirmation,
    },
    methods: {
        ...mapActions(["getAfterLoginPath"]),
    },
    computed: {
        ...mapGetters([
            "flashMessage",
            "showConfirmationBox",
            "showLogoutBox",
            "getRefresh",
        ]),
    },
    created() {
        sessionStorage.setItem("SHOW-NAV-TEXT", true);
    },
};
</script>

<style>
::-webkit-scrollbar {
    display: none;
}

@keyframes enterSlideLoginRegister {
    0% {
        opacity: 0;
        transform: translateX(-500px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes leaveSlideLoginRegister {
    0% {
        opacity: 1;
        transform: translateX(0);
    }
    100% {
        opacity: 0;
        transform: translateX(500px);
    }
}

.LoginRegister-enter-active {
    /* animation: enterSlideLoginRegister 0.5s ease-out; */
    animation: enterSlideLoginRegister 0.5s
        cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.LoginRegister-leave-active {
    animation: leaveSlideLoginRegister 0.5s
        cubic-bezier(0.55, 0.055, 0.675, 0.19);
}
</style>
