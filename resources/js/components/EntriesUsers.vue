<template>
    <div>
        <div class="bg-slate-300 p-2 rounded-md md:h-[80px] border border-slate-200 transition duration-500 flex justify-center items-center hover:shadow-2xl hover:bg-slate-200" :class="!isLastEntry? 'mb-5':''">
            <div class="w-full md:flex md:h-[80%] space-y-4 md:space-y-0">
                <div class="basis-[10%]">
                    <EntrySegmentUsers :value="user.id" :idField="true" class="h-full"/>
                </div>
                <div class="basis-[25%]">
                    <EntrySegmentUsers title="Name" :value="user.name" class="flex flex-col justify-center text-center sm:col-span-2 h-full" />
                </div>
                <div class="basis-[35%]">
                    <EntrySegmentUsers title="Email" :value="user.email" class="flex flex-col justify-center text-center sm:col-span-2 h-full" />
                </div>
                <div class="basis-[30%]">
                    <EntrySegmentUsers title="Role" :value="user.role" class="flex flex-col justify-center h-full"/>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import EntrySegmentUsers from './EntrySegmentUsers.vue'

export default {
    name: 'Entries',
    props: {
        user: Object,
    },
    data() {
        return {
            isLastEntry: false
        }
    },
    components: {
        EntrySegmentUsers
    },
    computed: {
        ...mapGetters(['allEntries', 'allUsers'])
    },
    created() {
        console.log(this.allUsers[0])
        // if(this.entry.id == this.allEntries[0][this.allEntries[0].length-1].id) {
        //     this.isLastEntry = true
        // }
    }   
}
</script>

<style>

</style>