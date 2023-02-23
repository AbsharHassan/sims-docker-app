<template>
    <div class="flex min-h-[35px] p-1 w-full items-center -mb-1.5">
        <div class="w-[180px] font-medium">{{ title }}:<slot></slot></div>
        <div class="mx-auto w-[60%]">
            <input
                v-bind="$attrs"
                class="h-[26px] input-bg border border-slate-500 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000 text-xs"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                :class="errorChecker(objKey) ? 'border-red-600' : ''"
            />
        </div>
    </div>
    <div v-if="allErrors[objKey]" class="px-1 text-sm text-red-600 sm:mb-2">
        {{ allErrors[objKey] }}
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "SmallBasicInput",
    props: {
        title: String,
        objKey: String,
        modelValue: [String, Number, File],
    },
    methods: {
        errorChecker(fieldName) {
            return this.allErrors.hasOwnProperty(fieldName);
        },
    },
    computed: {
        ...mapGetters(["allErrors"]),
    },
};
</script>

<style></style>
