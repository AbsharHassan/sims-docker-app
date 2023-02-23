<template>
  <div>
    <Loading v-model:active="loadingStatus" loader="bars" color="rgb(2 132 199 / 0.75)"  :height="100" :width="100" :on-cancel="onCancel" :can-cancel="loadingCancel" background-color="rgb(203 213 225)" :opacity="loadingOpacity"/>
    <div class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]" :class="`xl:grid-cols-[${navWidth}px_minmax(${navWidth}px,_1fr)]`">
        <Sidebar/>
        <Header/>
        <section>
            <div class="shadow-md m-5 p-5 relative">
                <div>
                    <div>
                        <div class="flex items-center justify-between px-1 mb-2">
                            <router-link :to="{name: 'Dashboard'}">
                                <div class="text-lg font-medium flex items-baseline hover:underline hover:underline-offset-2">
                                    <div class="mr-1">
                                        <i class="bi bi-arrow-left"></i>
                                    </div>
                                    <div>
                                        Back
                                    </div>
                                </div>
                            </router-link>
                            <router-link :to="{name: 'EditStudent', params:{student_id: $route.params.student_id}}">
                                <div class="float-right font-medium text-lg flex items-baseline">
                                    <div class="mr-2 ">
                                        Edit
                                    </div>
                                    <div>
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <BasicInfo :singleStudent="singleStudent" :singleFamily="singleFamily" :key="BasicInfoKey"/>
                        <EducationHistory :singleStudent="singleStudent" :key="EducationHistoryKey"/>
                        <GPASection :singleAcademics="singleAcademics" :currentSem="singleStudent.current_sem" :reasons="singleStudent.reason" @revealSemesterInfo="revealSemesterInfo($event)" @loadingOpacityModifier="loadingOpacityModifier()" :key="GPASectionKey"/>
                        <transition name="detailSection" appear>
                            <SemesterDetails v-if="showSemDetails" @closeSemDetails="closeSemDetails()" :academicsData="singleAcademics[`${this.academicsIndex - 1}`]" :key="SemesterDetailsKey"/>
                        </transition> 
                    </div>
                </div>
            </div>
        </section>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters} from 'vuex'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import Sidebar from '../../components/Sidebar.vue'
import Header from '../../components/Header.vue'
import BasicInfo from '../../components/BasicInfo.vue'
import EducationHistory from '../../components/EducationHistory.vue'
import GPASection from '../../components/GPASection.vue'
import SemesterDetails from '../../components/SemesterDetails.vue'

export default {
    name: 'StudentEntry',
    components: {
        Loading,
        Sidebar,
        Header,
        BasicInfo,
        EducationHistory,
        GPASection,
        SemesterDetails
    },
    data() {
        return {
            loadingCancel: true,
            loadingOpacity: null,
            academicsIndex: null,
            showSemDetails: false,
            BasicInfoKey: 0,
            EducationHistoryKey: 0,
            GPASectionKey: 0,
            SemesterDetailsKey: 0,
        }
    },
    methods: {
        ...mapActions(['getSingleEntry']),
        revealSemesterInfo(number) {
            if(this.singleAcademics[`${number - 1}`]) {
                this.academicsIndex = number
                this.showSemDetails = true
            } else {
                this.academicsIndex = null
            }
        },
        onCancel() {
            this.$router.push({name: 'Dashboard'})
        },
        loadingOpacityModifier() {
            this.loadingOpacity = 0.4
        },
        closeSemDetails() {
            this.showSemDetails = false
        }
    },
    computed: {
        ...mapGetters(['singleStudent', 'singleFamily', 'singleAcademics', 'loadingStatus', 'navWidth'])
    },
    async created() {
        this.loadingOpacity = 1
        await this.getSingleEntry(this.$route.params.student_id);
        this.BasicInfoKey++
        console.log(this.BasicInfoKey)
        this.EducationHistoryKey++
        console.log(this.EducationHistoryKey)
        this.GPASectionKey++ 
        console.log(this.GPASectionKey)
        this.SemesterDetailsKey++
        console.log(this.SemesterDetailsKey)
    },
}
</script>

<style>

.detailSection-enter-from, .detailSection-leave-to {
    opacity: 0;
    transform: scale(0);
}
.detailSection-enter-to {
    opacity: 1;
    transform: scale(1);
}
.detailSection-enter-active, .detailSection-leave-active {
    transition: all 0.5s ease;
}
.detailSection-move {
    transition: all 0.5s ease;
}

template{
    background-color: red;
}

</style>