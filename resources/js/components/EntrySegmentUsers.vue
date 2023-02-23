<template>
    <div class="mx-2 p-1.5 tracking-wider text-slate-800 shadow-lg rounded-md overflow-hidden whitespace-nowrap text-center" :class="idField ? 'bg-gray-100 hover:bg-white flex flex-col justify-center' : 'bg-sky-300/75 hover:bg-sky-400'">
        <div v-if="idField == false">
            <p class="font-medium">{{ title }}: </p>
            <p class="truncate">{{ value }}</p>
        </div>
        <div v-else>
            <div class="text-blue-500 font-bold text-sm">
                <p class="truncate">ID: {{ value }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EntrySegment',
    props: {
        title: String,
        value: [String, Number],
        idField: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style>

</style>