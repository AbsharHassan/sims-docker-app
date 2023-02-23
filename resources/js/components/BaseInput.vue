<template>
    <label
        class="inline-block mb-1 font-medium"
        :class="noWrapProp ? 'whitespace-nowrap' : ''"
    >
        {{ name }}
        <slot></slot>
    </label>
    <input
        v-bind="$attrs"
        class="input-bg border border-slate-300 rounded p-2 w-full focus:outline-0 focus:border-2 focus:border-cyan-700 transition duration-1000"
        :class="errorChecker(objKey) ? 'border-red-600' : ''"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
    <div v-if="allErrors[objKey]" class="text-sm text-red-600 sm:mb-2">
        {{ allErrors[objKey].replace(needsReplace, replacer) }}
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "BaseInput",
    model: {
        prop: String,
        event: String,
    },
    props: {
        name: String,
        objKey: String,
        needsReplace: String,
        replacer: String,
        noWrapProp: {
            type: Boolean,
            default: false,
        },
        modelValue: [String, Number, File],
    },
    computed: {
        ...mapGetters(["allErrors"]),
    },
    methods: {
        errorChecker(fieldName) {
            return this.allErrors.hasOwnProperty(fieldName);
        },
    },
};
</script>

<style></style>
