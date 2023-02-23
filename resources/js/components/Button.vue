<template>
    <button class="bg-sky-600 text-center py-3 rounded-lg text-white font-bold hover:bg-sky-700 transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
        <div class="flex items-center justify-center relative">
            <slot name="extraText"></slot>
            <div class="h-full flex items-center justify-center" v-if="!loadingStatus">
                {{ text }}
            </div>
            <div class="ml-2 text-xl spinner" v-if="loadingStatus">
                <slot name="spinnerIcon"></slot>
            </div>
        </div>
    </button>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'Button',
    props: {
        text: String,
        processingPresent: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        ...mapGetters(['loadingStatus'])
    }
}
</script>

<style>
.spinner {
    animation: spinLoading 2s linear infinite;
}

@keyframes spinLoading {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>