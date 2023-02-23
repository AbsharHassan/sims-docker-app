<template>
    <div class="fixed bottom-0 inset-x-0 mx-10 sm:mx-auto z-50 bg-slate-700 max-w-sm sm:max-w-xl mb-6 text-white rounded shadow-md p-8 border-l-[6px] border-l-black flex items-center">
        <div class="basis-[90%]">
            {{ flashMessage }}
        </div>
        <div class="basis-[10%]">
            <span @click="closeFlashMessage()" class="float-right top-0 right-0 hover:cursor-pointer">
                <i class="bi bi-x-lg"></i>
            </span>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
    name: 'FlashNotification',
    computed: {
        ...mapGetters(['flashMessage'])
    },
    methods: {
        ...mapActions(['setFlashMessage']),
        closeFlashMessage() {
            this.setFlashMessage(null)
        }
    },
    mounted() {
        setTimeout(() => {
                this.setFlashMessage(null)
            }, 5000)
    }
}
</script>

<style>
.flash-enter-active {
    animation: slideMomentumFlash 1.5s ease;
}
.flash-leave-active {
    animation: leaveSlideFlash 1s ease;
}

@keyframes slideMomentumFlash {
    0% {opacity: 0; transform: translateY(300px);}
    50% {opacity: 1; transform: translateY(-30px);}
    100% {transform: translateY(0);}
}

@keyframes leaveSlideFlash {
    0% {opacity: 1; transform: translateX(0);}
    50% {opacity: 1; transform: translateX(-50px);}
    100% {opacity: 0; transform: translateX(500px);}
}
</style>