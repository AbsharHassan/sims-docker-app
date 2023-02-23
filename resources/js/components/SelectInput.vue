<template>
    <label class="inline-block text-md mb-1 font-medium">
        {{ name }}
        <slot></slot>
    </label>
    <div v-bind="$attrs" class="input-bg rounded p-2 w-full h-[45px] flex items-center justify-center field" :class="errorChecker(objKey) ? 'field-error' : ''">
        <select class="bg-gray-100 w-full border border-gray-400 rounded" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
            <option v-for="entry in Object.keys(this.optionBag)" :key="entry" :value='entry'>{{ this.optionBag[entry] }}</option>
        </select>
    </div>
    <div v-if="allErrors[objKey]" class="text-sm text-red-600 sm:mb-2">
            {{ allErrors[objKey].replace(needsReplace, replacer) }}
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'SelectInput',
    props: {
        name: String,
        objKey: String,
        optionBag: Object,
        needsReplace: String,
        replacer: String,
        modelValue: [String, Number],
    },
    computed: {
        ...mapGetters(['allErrors']),
    },
    methods: {
        errorChecker(fieldName) {
            return (this.allErrors.hasOwnProperty(fieldName))
        },
    }

}
</script>

<style>

.field {
    border: 1px solid rgb(203 213 225);
}
.field-error {
    border: 1px solid rgb(220 38 38);
}

</style>