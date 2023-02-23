<template>
    <div class="h-screen flex items-center justify-center">
        <div
            class="bg-white/60 hover:bg-white/80 transition duration-300 sm:w-[600px] sm:h-[300px] rounded-md p-3"
        >
            <h3 class="font-bold text-lg sm:text-2xl">Recover Password</h3>
            <p class="text-slate-600 pt-5">
                Enter the email associated with your account.
            </p>
            <div class="mt-6">
                <form @submit="onSubmit">
                    <div
                        class="mb-6 pt-3 rounded bg-slate-200/75 max-w-md mx-auto"
                    >
                        <!-- <BasicAuthenticationInput
                            v-model="formFields.email"
                            name="Email"
                            type="email"
                            :class="allErrors == 401 ? 'border-red-600' : ''"
                            objKey="email"
                        /> -->
                        <BasicAuthenticationInput
                            v-model="formFields.email"
                            name="Email"
                            type="email"
                            :class="allErrors == 401 ? 'border-red-600' : ''"
                            objKey="email"
                        />
                    </div>
                    <Button
                        :text="!loadingStatus ? 'Submit' : ''"
                        :processingPresent="true"
                        class="w-[400px] mx-auto mt-10 h-[50px]"
                        @click="onSubmit"
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
            </div>
        </div>
    </div>
</template>

<script>
import BasicAuthenticationInput from "../components/BasicAuthenticationInput.vue";
import Button from "../components/Button.vue";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "GetPassword",
    components: {
        BasicAuthenticationInput,
        Button,
    },
    methods: {
        ...mapActions(["setFlashMessage", "forgotPasswordForm"]),
        flashRedirect() {
            this.setFlashMessage(
                "A recovery link will be sent to this email. (Feature in progress)"
            );
            this.$router.push({ name: "Login" });
        },
        async onSubmit(e) {
            e.preventDefault();
            this.flashRedirect();
            // await this.forgotPasswordForm(this.formFields);
        },
    },
    computed: {
        ...mapGetters(["allErrors", "loadingStatus"]),
    },
    data() {
        return {
            formFields: {
                email: null,
            },
        };
    },
};
</script>

<style></style>
