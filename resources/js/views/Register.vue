<template>
    <div
        class="sm:overflow-hidden overflow-y-clip h-full flex items-center justify-center"
    >
        <div>
            <header class="max-w-lg mx-auto px-2 md:px-0">
                <h1
                    class="text-xl sm:text-3xl text-center mx-auto mt-10 pb-1 md:text-3xl font-bold"
                >
                    Student Information Management System
                </h1>
            </header>
            <main class="max-w-lg mx-auto mb-10 mt-4 px-3 md:p-0">
                <div
                    class="bg-white/40 hover:bg-white/60 rounded-lg shadow-lg hover:shadow-2xl transition duration-500 p-8 md:p-8"
                >
                    <section>
                        <h3 class="font-bold text-lg sm:text-2xl">
                            Welcome to the Registeration Page
                        </h3>
                        <p class="text-gray-600 pt-4">Create your account.</p>
                    </section>
                    <section class="mt-4">
                        <div
                            v-if="
                                allErrors['password'] &&
                                allErrors['password'] ==
                                    'The password confirmation does not match.'
                            "
                            class="block sm:hidden text-sm font-bold text-red-600 mb-3"
                        >
                            {{ allErrors["password"] }}
                        </div>
                        <form class="flex flex-col" @submit="onSubmit">
                            <div class="mb-2 pt-3 rounded-t bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.name"
                                    name="Name"
                                    type="text"
                                    objKey="name"
                                    class="rounded"
                                />
                            </div>
                            <div class="mb-2 pt-3 bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.email"
                                    name="Email"
                                    type="email"
                                    objKey="email"
                                    class="rounded"
                                />
                            </div>
                            <div class="mb-2 pt-3 bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.password"
                                    name="Password"
                                    type="password"
                                    objKey="password"
                                    class="rounded"
                                />
                            </div>
                            <div class="mb-3 pt-3 rounded-b bg-slate-200/75">
                                <BasicAuthenticationInput
                                    v-model="formFields.password_confirmation"
                                    name="Confirm Password"
                                    type="password"
                                    objKey="password_confirmation"
                                    class="rounded"
                                />
                            </div>
                            <div class="flex justify-end">
                                <div class="text-xs sm:text-sm text-sky-600">
                                    Already have an account?
                                    <router-link
                                        :to="{ name: 'Login' }"
                                        class="hover:text-sky-700 underline"
                                        >Sign in.</router-link
                                    >
                                </div>
                            </div>
                            <Button
                                :text="!loadingStatus ? 'Register' : ''"
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
        </div>
    </div>
</template>

<script>
import BasicAuthenticationInput from "../components/BasicAuthenticationInput.vue";
import Button from "../components/Button.vue";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "Register",
    components: {
        BasicAuthenticationInput,
        Button,
    },
    data() {
        return {
            formFields: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
        };
    },
    methods: {
        ...mapActions(["createUser", "clearErrorMessages"]),
        async onSubmit(e) {
            e.preventDefault();
            await this.createUser(this.formFields);
        },
    },
    computed: {
        ...mapGetters(["loadingStatus", "allErrors"]),
    },
    created() {
        this.clearErrorMessages();
    },
};
</script>

<style>
@keyframes slideMomentumRegister {
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

.register-enter-active {
    animation: slideMomentumRegister 1s ease;
}
</style>
