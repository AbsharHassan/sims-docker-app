<template>
    <div>
        <div
            class="h-full md:grid md:grid-rows-[60px_minmax(60px,_1fr)]"
            :class="
                showNavText
                    ? 'xl:grid-cols-[120px_minmax(120px,_1fr)]'
                    : 'xl:grid-cols-[60px_minmax(60px,_1fr)]'
            "
        >
            <Sidebar />
            <Header />
            <Loading
                v-model:active="loadingStatus"
                loader="bars"
                color="rgb(2 132 199 / 0.75)"
                class="bg-slate-300/40"
                :height="100"
                :width="100"
            />
            <div
                class="shadow-md m-5 px-5 pt-1 pb-5 hover:shadow-2xl transition duration-500 border-t-8 border-t-sky-500/20 flex flex-wrap items-center xl:items-center justify-evenly min-h-[85vh] xl:max-h-[90%]"
            >
                <div class="xl:flex h-full w-full">
                    <div class="min-w-[35%] sm:mr-5">
                        <div
                            class="mt-5 bg-slate-100/60 max-w-[380px] min-w-[300px] flex flex-col items-center pt-3 pb-0 rounded-md shadow-md border-2 border-transparent hover:shadow-2xl hover:border-cyan-600 hover:bg-white/60 transition duration-500 mx-auto sm:h-[90%]"
                        >
                            <div
                                class="bg-sky-500/20 mb-2 w-full flex items-center justify-between px-1"
                            >
                                <router-link :to="{ name: 'Home' }">
                                    <div
                                        class="basis-[7%] text-sm sm:text-base flex items-baseline hover:underline hover:underline-offset-2"
                                    >
                                        <div>
                                            <i class="bi bi-arrow-left"></i>
                                        </div>
                                        <div>Back</div>
                                    </div>
                                </router-link>
                                <div
                                    class="text-slate-600 my-3 text-center font-semibold text-base sm:text-xl basis-[86%]"
                                >
                                    Your Profile
                                </div>
                                <div
                                    v-if="showSection == 'details'"
                                    class="basis-[7%] text-sm sm:text-base flex items-baseline hover:cursor-pointer"
                                    @click="showSection = 'edit'"
                                >
                                    <div class="mr-2">Edit</div>
                                    <div>
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                </div>
                                <div
                                    v-if="
                                        showSection == 'edit' ||
                                        showSection == 'password'
                                    "
                                    class="basis-[7%] text-sm sm:text-base flex items-baseline hover:cursor-pointer"
                                    @click="showSection = 'details'"
                                >
                                    <div class="mr-2">Details</div>
                                </div>
                            </div>
                            <div
                                class="w-full mt-3 sm:mt-0 h-[300px] py-2 sm:py-0 border-y-2 border-y-slate-200 flex flex-col items-center justify-center"
                            >
                                <img
                                    src="/images/pfp.jpg"
                                    class="max-h-[200px] w-auto w-min-[100px]"
                                    alt=""
                                />
                                <div
                                    class="mt-3 text-xs text-sky-500 underline underline-offset-4 text-center"
                                >
                                    <div class="mb-3">
                                        Change profile picture
                                    </div>
                                    <div
                                        class="hover:cursor-pointer"
                                        @click="showSection = 'password'"
                                    >
                                        Change password
                                    </div>
                                </div>
                            </div>
                            <div class="min-h-[200px] w-full">
                                <!-- <transition
                                    name="slideForToggle"
                                    appear
                                    mode="out-in"
                                > -->
                                <div
                                    v-if="showSection == 'details'"
                                    class="min-h-[200px] flex flex-col justify-evenly"
                                >
                                    <div class="flex my-1 px-2 mt-2 w-full">
                                        <BasicEntry
                                            title="Name"
                                            :value="currentUser.name"
                                            class="w-full"
                                        />
                                    </div>
                                    <div class="flex my-1 px-2 mt-2 w-full">
                                        <BasicEntry
                                            title="Email"
                                            :value="currentUser.email"
                                            class="w-full"
                                        />
                                    </div>
                                    <div class="flex my-1 px-2 mt-2 w-full">
                                        <BasicEntry
                                            title="Role"
                                            :value="currentUser.role"
                                            class="w-full"
                                        />
                                    </div>
                                </div>
                                <div v-else-if="showSection == 'edit'">
                                    <form @submit="onDetailsSubmit">
                                        <div class="my-1 px-2 mt-2 w-full">
                                            <SmallBasicInput
                                                title="Name"
                                                v-model="formFields.name"
                                                objKey="name"
                                                type="text"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </SmallBasicInput>
                                        </div>
                                        <div class="my-1 px-2 mt-2 w-full">
                                            <SmallBasicInput
                                                title="Email"
                                                v-model="formFields.email"
                                                objKey="email"
                                                type="text"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </SmallBasicInput>
                                        </div>
                                        <div class="my-1 px-2 mt-2 w-full">
                                            <SmallBasicInput
                                                title="Role"
                                                v-model="formFields.role"
                                            />
                                        </div>
                                        <div class="my-1 px-2 mt-2 w-full">
                                            <SmallBasicInput
                                                title="Current Password"
                                                v-model="formFields.password"
                                                objKey="password"
                                                type="password"
                                            >
                                                <span class="text-red-600">
                                                    *
                                                </span>
                                            </SmallBasicInput>
                                        </div>
                                        <div class="my-1 px-3 mt-3 w-full">
                                            <Button
                                                text="Update Details"
                                                class="h-[28px] m-0 py-1 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black w-full"
                                                @submit="onDetailsSubmit"
                                            >
                                                <template
                                                    #extraText
                                                    v-if="loadingStatus"
                                                >
                                                    <span class="font-bold">
                                                        Processing
                                                    </span>
                                                </template>
                                                <template
                                                    #spinnerIcon
                                                    v-if="loadingStatus"
                                                >
                                                    <span>
                                                        <i
                                                            class="bi bi-arrow-repeat"
                                                        ></i>
                                                    </span>
                                                </template>
                                            </Button>
                                        </div>
                                    </form>
                                </div>
                                <div v-else>
                                    <form @submit="onPasswordSubmit">
                                        <div
                                            class="min-h-[200px] flex flex-col justify-evenly"
                                        >
                                            <div class="my-1 px-2 mt-2 w-full">
                                                <SmallBasicInput
                                                    title="Current Password"
                                                    v-model="
                                                        formFieldsPassword.old_password
                                                    "
                                                    type="password"
                                                    objKey="error"
                                                >
                                                    <span class="text-red-600">
                                                        *
                                                    </span>
                                                </SmallBasicInput>
                                                <div
                                                    v-if="
                                                        allErrors ==
                                                            'Incorrect current password.' &&
                                                        showSection ==
                                                            'password'
                                                    "
                                                    class="text-red-600 ml-1"
                                                >
                                                    {{ allErrors }}
                                                </div>
                                            </div>
                                            <div class="my-1 px-2 mt-2 w-full">
                                                <SmallBasicInput
                                                    title="New Password"
                                                    v-model="
                                                        formFieldsPassword.password
                                                    "
                                                    type="password"
                                                    objKey="password"
                                                >
                                                    <span class="text-red-600">
                                                        *
                                                    </span>
                                                </SmallBasicInput>
                                            </div>
                                            <div
                                                class="my-1 px-2 mt-2 w-full"
                                                type="password"
                                            >
                                                <SmallBasicInput
                                                    title="Confirm Password"
                                                    v-model="
                                                        formFieldsPassword.password_confirmation
                                                    "
                                                    type="password"
                                                >
                                                    <span class="text-red-600">
                                                        *
                                                    </span>
                                                </SmallBasicInput>
                                            </div>
                                            <div class="my-1 px-3 mt-3 w-full">
                                                <Button
                                                    text="Update Password"
                                                    class="h-[28px] m-0 py-1 px-6 rounded-md bg-sky-700 text-white text-xs font-normal hover:bg-black w-full"
                                                    @submit="onPasswordSubmit"
                                                >
                                                    <template
                                                        #extraText
                                                        v-if="loadingStatus"
                                                    >
                                                        <span class="font-bold">
                                                            Processing
                                                        </span>
                                                    </template>
                                                    <template
                                                        #spinnerIcon
                                                        v-if="loadingStatus"
                                                    >
                                                        <span>
                                                            <i
                                                                class="bi bi-arrow-repeat"
                                                            ></i>
                                                        </span>
                                                    </template>
                                                </Button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- </transition> -->
                            </div>
                        </div>
                    </div>
                    <div
                        class="basis-[70%] mt-5 bg-slate-100/60 rounded-md shadow-md border-2 border-transparent hover:shadow-2xl hover:border-cyan-600 hover:bg-white/60 transition duration-500 mx-auto xl:h-[90%] overflow-y-scroll"
                    >
                        <div v-for="user in this.allUsers[0]" :key="user.id">
                            <EntriesUser :user="user" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BasicEntry from "../../components/BasicEntry.vue";
import SmallBasicInput from "../../components/SmallBasicInput.vue";
// import EntriesUser from '../../components/EntriesUser.vue'
import EntriesUser from "../../components/EntriesUsers.vue";
import Sidebar from "../../components/Sidebar.vue";
import Header from "../../components/Header.vue";
import Entries from "../../components/Entries.vue";
import Button from "../../components/Button.vue";
import { mapActions, mapGetters } from "vuex";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
    name: "Dashboard",
    components: {
        Sidebar,
        Header,
        Entries,
        Button,
        Loading,
        BasicEntry,
        SmallBasicInput,
        EntriesUser,
    },
    methods: {
        ...mapActions(["editCurrentUser", "changePassword", "getAllUsers"]),
        async onDetailsSubmit(e) {
            e.preventDefault();
            await this.editCurrentUser(this.formFields);
            if (Object.keys(this.allErrors).length == 0) {
                this.formFields.id = sessionStorage.getItem("CURRENT-USER-ID");
                this.formFields.email =
                    sessionStorage.getItem("CURRENT-USER-EMAIL");
                this.formFields.name =
                    sessionStorage.getItem("CURRENT-USER-NAME");
                this.formFields.role =
                    sessionStorage.getItem("CURRENT-USER-ROLE");
            }
        },
        async onPasswordSubmit(e) {
            e.preventDefault();
            await this.changePassword(this.formFieldsPassword);
        },
    },
    computed: {
        ...mapGetters([
            "loadingStatus",
            "showNavText",
            "allErrors",
            "currentUser",
            "allUsers",
        ]),
    },
    data() {
        return {
            formFields: {
                id: sessionStorage.getItem("CURRENT-USER-ID"),
                name: sessionStorage.getItem("CURRENT-USER-NAME"),
                email: sessionStorage.getItem("CURRENT-USER-EMAIL"),
                role: sessionStorage.getItem("CURRENT-USER-ROLE"),
                password: null,
            },
            showSection: "details",
            formFieldsPassword: {
                id: sessionStorage.getItem("CURRENT-USER-ID"),
                old_password: null,
                password: null,
                password_confirmation: null,
            },
        };
    },
    async created() {
        await this.getAllUsers();
        console.log(this.allUsers);
    },
};
</script>

<style>
@keyframes enterSlideDetails {
    0% {
        opacity: 0;
        transform: translateX(-175px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes leaveSlideDetails {
    0% {
        opacity: 1;
        transform: translateX(0);
    }
    100% {
        opacity: 0;
        transform: translateX(175px);
    }
}

.slideForToggle-enter-active {
    /* animation: enterSlideLoginRegister 0.5s ease-out; */
    animation: enterSlideLoginRegister 0.5s
        cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.slideForToggle-leave-active {
    animation: leaveSlideLoginRegister 0.5s
        cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

/* .slideForToggle-enter-from {
    opacity: 0;
    transform: translateX(-300px);
}
.slideForToggle-enter-to {
    opacity: 1;
    transform: translateX(0);
}
.slideForToggle-enter-active {
    transition: all 0.5s ease-out;
}
.slideForToggle-move {
    transition: all 0.5s ease-out;
} */
</style>
