<template>
    <div @mouseover="modifyOnHover()" @mouseleave="revertAfterHover()" id="parent" class="mb-3 md:mb-0 lg:flex rounded border border-transparent hover:bg-slate-400/75 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-400 transition duration-500 p-1">
        <div :id="title + value + ' '" class="transition duration-500 text-center lg:text-left lg:w-[115px] font-medium" :style="{width: widthValue}"><p class="lg:no-underline">{{ semesterTitle }} {{ title }}:</p></div>
        <div :id="title + value" class="mx-auto transition duration-500 bg-slate-400/75 rounded-sm w-full md:w-[200px] text-center" :class="hoverStatus? 'w-auto':''" :title="value"><p class="px-2 transition-all duration-500" :class="!hoverStatus? 'overflow-hidden whitespace-nowrap overflow-ellipsis' : 'overflow-x-visible'">{{ valueUse }}<span v-if="age"> ({{age}} years)</span></p></div>
    </div>
</template>

<script>
export default {
    name: 'BasicEntry',
    props: {
        title: [String, Number, Object],
        value: [String, Number, Object],
        underlineControl: {
            type: Boolean,
            default: true
        },
        age: {
            type: Number,
            default: null
        },
        widthValue: String,
        semesterTitle: {
            type: [String, Number],
            default: ''
        }
    },
    data() {
        return {
            hoverStatus: false
        }
    },
    methods: {
        modifyOnHover() {
            this.hoverStatus = true
            document.getElementById(this.title + this.value).style.backgroundColor = 'transparent'
            if(window.innerWidth < '1024' && this.underlineControl) {
                document.getElementById(this.title + this.value + ' ').style.textDecorationLine = 'underline'
                document.getElementById(this.title + this.value + ' ').style.textUnderlineOffset = '2px'
            }
        },
        revertAfterHover(){
            this.hoverStatus = false
            document.getElementById(this.title + this.value).style.backgroundColor = 'rgb(148 163 184 / 0.75)'
            document.getElementById(this.title + this.value + ' ').style.textDecorationLine = 'none'
        },
    },
    created() {
        if(this.$props.value == 'null' || this.$props.value == undefined) {
            this.valueUse = 'Not defined yet.'
        } else {
            this.valueUse = this.$props.value
        }
    }
}
</script>

<style>

</style>