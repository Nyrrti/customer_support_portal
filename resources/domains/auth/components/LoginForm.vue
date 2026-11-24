<script setup lang="ts">
    import { ref } from 'vue';
    import {authStore} from "../../auth/store";
    import { useRoute, useRouter } from "vue-router";
    import { useForm } from "../../../js/composables/useForm";
    import FieldError from "../../../js/components/FieldError.vue";

    const route = useRoute();
    const router = useRouter();
    const { errors, saving, submit, clearError } = useForm();
    
    const {
        errors: resendErrors,
        saving: resending,
        submit: submitResend,
        clearError: clearResendError,
    } = useForm();

    const form = ref({
        email: "",
        password: "",
    });

   /** Success messages that can be shown when arriving on the login page. */
    const successMessages = {
        verified: {
            title: "Email confirmed",
            text: "Your account is ready. You can log in now.",
        },
        reset: {
            title: "Password changed",
            text: "You can log in with your new password.",
        },
        resent: {
            title: "Email sent",
            text: "Check your inbox for a new confirmation link.",
        },
    };

    /**
     * The success message to show, based on the URL:
     * ?success=1 after confirming an email, ?reset=1 after a password reset.
     */
    const successMessage = ref(
        route.query.success === "1" ? successMessages.verified
        : route.query.reset === "1" ? successMessages.reset
        : null
    );

    /** Shown when the user arrives from an expired or invalid verification link. */
    const linkErrors = ref<string[]>(
        route.query.verification === "invalid"
            ? ["This confirmation link has expired or is invalid. Log in to request a new one."]
            : []
    );

    /**
     * Hides the success message and removes it from the URL,
     * so it doesn't show again after a refresh.
     */
    function dismissSuccess(): void {
        successMessage.value = null;
        router.replace({ query: {} });
    }

    /**
     * Logs the user in and sends them to their tickets.
     * Wrong credentials and unconfirmed emails are shown under the email field.
     */
    async function handleLogin(): Promise<void> {
        const success = await submit(() =>
            authStore.login(form.value.email, form.value.password)
        );

        if (success) {
            await router.push("/tickets");
        }
    }

    /**
     * Sends a new verification email to the address in the login form.
     * On success the login error is replaced by a success message.
     */
    async function resendVerification(): Promise<void> {
        const success = await submitResend(() =>
            authStore.resendVerification(form.value.email)
        );

        if (success) {
            clearError("unverified");
            successMessage.value = successMessages.resent;
        }
    }

</script>

<template>
    <div>
        <form @submit.prevent="handleLogin" class="login-bg p-4">
            <div class="login-heading py-2">
                <div class="login-icon">
                    L
                </div>
                <div>
                    <h5>
                        Login to your account
                    </h5>
                    <p>
                        Access your tickets and continue where you left off.
                    </p>
                </div>
                
            </div>
            <div v-if="successMessage" class="success-message" role="status">
                <div class="success-icon" aria-hidden="true">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M5 12.5l4.5 4.5L19 7.5" />
                    </svg>
                </div>
                <div class="success-text">
                    <p class="success-title">{{ successMessage.title }}</p>
                    <p>{{ successMessage.text }}</p>
                </div>
                <button
                    type="button"
                    class="btn remove-message"
                    aria-label="Dismiss message"
                    @click="dismissSuccess"
                >
                    ×
                </button>
            </div>
            <div class="login-input-field">
                <FieldError :errors="linkErrors" @dismiss="linkErrors = []" />
                <div class="field">
                    <label for="email">
                        Email address
                    </label>
                    <input 
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                    >
                    <FieldError
                        :errors="errors.email"
                        @dismiss="clearError('email')"
                    />
                    <div v-if="errors.unverified" class="unverified">
                        <FieldError
                            :errors="errors.unverified"
                            @dismiss="clearError('unverified')"
                        />
                        <button
                            type="button"
                            class="btn resend"
                            :disabled="resending"
                            @click="resendVerification"
                        >
                            {{ resending ? "Sending..." : "Resend confirmation email" }}
                        </button>
                        <FieldError
                            :errors="resendErrors.email"
                            @dismiss="clearResendError('email')"
                        />
                    </div>
                </div>
                <div class="field">
                    <label for="password">
                        Password
                    </label>
                    <input 
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        required
                    >
                    <FieldError
                        :errors="errors.password"
                        @dismiss="clearError('password')"
                    />
                </div>
            </div>
            <div class="bottom-row">
                <div class="remember-field mt-2">
                    <div class="remember">
                        <input id="remember" type="checkbox">
                        <label for="remember">
                            Remember me
                        </label>
                    </div>
                    <RouterLink :to="{name: 'forgot-password'}" class="forgot-password">
                        Forgot password?
                    </RouterLink>
                </div>
                <button class="btn login" type="submit" :disabled="saving">
                    {{ saving ? "Logging in..." : "Log in" }}
                </button>
            </div>
            
        </form>
    </div>
</template>



<style scoped>

    .login-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
    }

    .login-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .login-heading p {
        color: var(--font-color-medium-dark);
        font-size: var(--text-body);
    }

    .login-icon {
        width: 3rem;
        height: 3rem;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        border-radius: 0.75rem;
    }

    .login-input-field {
        display: flex;
        flex-direction: column;
        gap:0.65rem;
    }

    .login-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .bottom-row {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .remember-field {
        display: flex;
        justify-content: space-between;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .bottom-row a {
        font-size: var(--text-body);
        color: var(--color-blue);
        font-weight: 500;
    }

    .btn.login {
        width: 100%;
    }

    .success-message {
        --success-bg: #d4efdf;
        --success-border: #2f9e5f;
        --success-text: #17663a;

        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        margin-bottom: 1.25rem;
        background-color: var(--success-bg);
        border: 1px solid var(--success-border);
        border-left-width: 4px;
        border-radius: 0.4rem;
    }

    .success-icon {
        width: 2rem;
        height: 2rem;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--success-border);
        color: #fff;
        border-radius: 0.5rem;
    }

    .success-icon svg {
        width: 1.1rem;
        height: 1.1rem;
    }

    .success-text {
        flex: 1;
    }

    .success-title {
        font-weight: 600;
        font-size: var(--text-body);
        color: var(--success-text);
    }

    .success-text p:last-child {
        font-size: var(--text-label);
        color: var(--success-text);
    }

    .btn.remove-message {
        height: 1.5rem;
        width: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 1rem;
        background-color: transparent;
        color: var(--success-text);
        font-size: 1.25rem;
        cursor: pointer;
    }

    .unverified {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .btn.resend {
        align-self: flex-start;
        padding: 0;
        border: 0;
        background: transparent;
        color: var(--color-blue);
        font-size: var(--text-label);
        font-weight: 500;
        cursor: pointer;
    }

    .btn.resend:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>