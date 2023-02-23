<template>
    <div class="sm:overflow-hidden h-full flex items-center justify-center">
        <div>
            <header class="max-w-lg mx-auto px-2 md:px-0">
                <h1
                    class="text-xl sm:text-3xl text-center mx-auto mt-16 sm:mt-10 pb-1 md:text-3xl font-bold"
                >
                    Student Information Management System
                </h1>
            </header>
            <main
                class="max-w-lg mx-auto p-3 mb-5 mt-3 sm:mb-10 sm:mt-6 md:p-0"
            >
                <div
                    class="bg-white/40 hover:bg-white/60 rounded-lg shadow-lg hover:shadow-2xl transition duration-500 p-8 md:p-12"
                >
                    <h3 class="font-bold text-lg sm:text-2xl">
                        Welcome to the Login Page
                    </h3>
                    <p class="text-slate-600 pt-5">Sign into your account.</p>
                    <section class="mt-8">
                        <form class="flex flex-col" @submit="onSubmit">
                            <div class="mb-6 pt-3 rounded bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.email"
                                    name="Email"
                                    type="email"
                                    :class="
                                        allErrors == 401 ? 'border-red-600' : ''
                                    "
                                    objKey="email"
                                />
                            </div>
                            <div class="mb-6 pt-3 rounded bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.password"
                                    name="Password"
                                    :type="showPassword ? 'text' : 'password'"
                                    @togglePassword="togglePassword()"
                                    :class="
                                        allErrors == 401 ? 'border-red-600' : ''
                                    "
                                    objKey="password"
                                >
                                    <i
                                        v-if="showPassword"
                                        class="bi bi-eye-slash-fill"
                                    ></i>
                                    <i v-else class="bi bi-eye-fill"></i>
                                </BasicAuthenticationInput>
                            </div>
                            <div class="sm:h-[25px]">
                                <div
                                    class="text-center sm:text-left sm:flex justify-between items-baseline"
                                >
                                    <div
                                        class="font-bold text-red-600 badCreds"
                                    >
                                        <div v-if="allErrors == 401">
                                            Invalid Creditentials.
                                        </div>
                                    </div>
                                    <div>
                                        <router-link
                                            :to="{ name: 'GetPassword' }"
                                            class="text-sm text-sky-600 hover:text-sky-700 hover:underline mb-6"
                                            >Forgot your password?</router-link
                                        >
                                    </div>
                                </div>
                            </div>
                            <Button
                                :text="!loadingStatus ? 'Sign In' : ''"
                                :processingPresent="true"
                                class="mt-5 h-[50px]"
                                @submit="onSubmit"
                            >
                                <template #extraText v-if="loadingStatus">
                                    Processing
                                </template>
                                <template #spinnerIcon v-if="loadingStatus">
                                    <span>
                                        <i class="bi bi-arrow-repeat"></i>
                                    </span>
                                </template>
                            </Button>
                        </form>
                    </section>
                </div>
            </main>
            <section>
                <div class="max-w-lg mx-auto text-center mt-[-8px] mb-6">
                    <p class="text-sky-800">
                        Don't have an account?
                        <router-link
                            :to="{ name: 'Register' }"
                            class="font-bold hover:underline"
                            >Sign up here</router-link
                        >.
                    </p>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import BasicAuthenticationInput from "../components/BasicAuthenticationInput.vue";
import Button from "../components/Button.vue";
import { mapActions, mapGetters } from "vuex";
import axios from "axios";

export default {
    name: "Login",
    components: {
        BasicAuthenticationInput,
        Button,
    },
    data() {
        return {
            showPassword: false,
            formFields: {
                email: null,
                password: null,
            },
        };
    },
    methods: {
        ...mapActions(["loginUser", "clearErrorMessages", "getAfterLoginPath"]),
        async onSubmit(e) {
            e.preventDefault();
            await this.loginUser(this.formFields);
        },
        togglePassword() {
            this.showPassword = !this.showPassword;
        },
    },
    computed: {
        ...mapGetters(["allErrors", "loadingStatus"]),
    },
    created() {
        this.clearErrorMessages();
    },
};
</script>

<style>
@keyframes slideMomentumLogin {
    0% {
        opacity: 0;
        transform: translateY(300px);
    }
    50% {
        opacity: 1;
        transform: translateY(-30px);
    }
    100% {
        transform: translateY(0);
    }
}

.slideUp-enter-active {
    animation: slideMomentumLogin 1s ease;
}

.badCreds {
    animation: badCreds 1s step-start infinite;
    /* animation: badCreds 1s step-start 15 2s ; */
}

@keyframes badCreds {
    50% {
        opacity: 0;
    }
}
</style>
