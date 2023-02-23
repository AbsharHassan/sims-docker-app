<template>
    <label
        class="text-slate-700 text-sm font-bold mb-2 ml-3 pr-8 w-full flex justify-between h-5"
    >
        <div>
            {{ name }}
        </div>
        <div class="flex flex-col">
            <div
                v-if="
                    allErrors[objKey] &&
                    allErrors[objKey] !=
                        'The password confirmation does not match.' &&
                    allErrors[objKey] != 'The email has already been taken.'
                "
                class="text-sm text-red-600 mb-0"
            >
                Required
            </div>
            <div
                v-if="
                    allErrors[objKey] &&
                    allErrors[objKey] == 'The email has already been taken.'
                "
                class="text-sm text-red-600 mb-0"
            >
                Already taken
            </div>
            <div
                v-if="
                    allErrors[objKey] &&
                    allErrors[objKey] ==
                        'The password confirmation does not match.'
                "
                class="hidden sm:block text-sm text-red-600 mb-0"
            >
                {{ allErrors[objKey] }}
            </div>
            <div
                @click="togglePassword()"
                class="text-lg text-right hover:cursor-pointer hover:text-black"
                :class="
                    allErrors[objKey]
                        ? 'translate-y-[18px] -mt-3 '
                        : 'translate-y-[38px] -mt-3 '
                "
            >
                <slot></slot>
            </div>
        </div>
    </label>
    <input
        v-bind="$attrs"
        class="bg-transparent w-full text-slate-700 focus:outline-0 border-b-4 border-slate-300 focus:border-blue-300 transition-colors duration-500 px-3"
        :value="modelValue"
        :class="errorChecker(objKey) ? 'flickerBorder' : ''"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "BasicAuthenticationInput",
    model: {
        prop: String,
        event: String,
    },
    props: {
        name: String,
        objKey: String,
        needsReplace: String,
        replacer: String,
        modelValue: [String, Number],
    },
    methods: {
        togglePassword() {
            this.$emit("togglePassword");
        },
        errorChecker(fieldName) {
            return this.allErrors.hasOwnProperty(fieldName);
        },
    },
    computed: {
        ...mapGetters(["allErrors"]),
    },
};
</script>

<style>
.flickerBorder {
    animation: flickerRegister 1s step-start infinite;
}

@keyframes flickerRegister {
    /* 0% {border-color: rgb(220 38 38 );} */
    50% {
        border-color: rgb(220 38 38);
    }
    /* 100% {border-color: rgb(220 38 38 );} */
}
</style>
