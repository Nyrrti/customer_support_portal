<script setup lang="ts">
    import { ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { authStore } from "../../auth/store";
    import type { RegisterUser } from "../types";
    import { useForm } from "../../../js/composables/useForm";
    import FieldError from "../../../js/components/FieldError.vue";

    const router = useRouter();
    const { errors, saving, submit, clearError } = useForm();

    const form = ref<RegisterUser>({
        first_name: "",
        last_name: "",
        email: "",
        phone_number: "",
        password: "",
        password_confirmation: "",
    });

    /**
     * Creates the account, logs the new user in
     * and sends them to their tickets.
     */
    async function handleRegister() {
        const success = await submit(() => authStore.register(form.value));

        if (success) {
            await router.push("/tickets");
        }
    }
</script>

<template>
    <form @submit.prevent="handleRegister" class="register-bg p-4 mt-5">
        <div class="register-heading py-2">
            <div class="register-icon">
                R
            </div>
            <div>
                <h5>
                    Create your account
                </h5>
                <p>
                    Submit and track your support tickets in one place.
                </p>
            </div>
        </div>
        <div class="register-input-field">
            <div class="name-row">
                <div class="field">
                    <label for="firstName">
                        First name
                    </label>
                    <input
                        id="firstName"
                        v-model="form.first_name"
                        type="text"
                        autocomplete="given-name"
                        required
                    >
                    <FieldError
                        :errors="errors.first_name"
                        @dismiss="clearError('first_name')"
                    />
                </div>
                <div class="field">
                    <label for="lastName">
                        Last name
                    </label>
                    <input
                        id="lastName"
                        v-model="form.last_name"
                        type="text"
                        autocomplete="family-name"
                        required
                    >
                    <FieldError
                        :errors="errors.last_name"
                        @dismiss="clearError('last_name')"
                    />
                </div>
            </div>
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
            </div>
            <div class="field">
                <label for="phoneNumber">
                    Phone number <span class="optional">(optional)</span>
                </label>
                <input
                    id="phoneNumber"
                    v-model="form.phone_number"
                    type="tel"
                    autocomplete="tel"
                >
                <FieldError
                    :errors="errors.phone_number"
                    @dismiss="clearError('phone_number')"
                />
            </div>
            <div class="field">
                <label for="password">
                    Password
                </label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                    required
                >
                <FieldError
                    :errors="errors.password"
                    @dismiss="clearError('password')"
                />
            </div>
            <div class="field">
                <label for="passwordConfirmation">
                    Confirm password
                </label>
                <input
                    id="passwordConfirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                >
            </div>
        </div>
        <div class="bottom-row">
            <button class="btn register" type="submit" :disabled="saving">
                {{ saving ? "Creating account..." : "Create account" }}
            </button>
            <p class="login-link">
                Already have an account?
                <RouterLink :to="{ name: 'home' }">Log in</RouterLink>
            </p>
        </div>
    </form>
</template>

<style scoped>

    .register-bg {
        align-self: start;
        background-color: var(--bg-color-card);
        border-radius: 0.6rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
    }

    .register-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .register-heading p {
        color: var(--font-color-medium-dark);
        font-size: var(--text-body);
    }

    .register-icon {
        width: 3rem;
        height: 3rem;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--color-purple);
        color: var(--font-color-light);
        border-radius: 0.75rem;
    }

    .register-input-field {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    .name-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem;
    }

    .register-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .optional {
        color: var(--font-color-medium-dark);
        font-weight: 400;
    }

    .bottom-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn.register {
        width: 100%;
        background-color: var(--color-purple);
        color: var(--font-color-light);
        padding-block: 0.75rem;
    }

    .btn.register:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .login-link {
        text-align: center;
        font-size: var(--text-body);
        color: var(--font-color-medium-dark);
    }

    .login-link a {
        color: var(--color-blue);
        font-weight: 500;
    }

    /* Stack first and last name on small screens */
    @media (max-width: 480px) {
        .name-row {
            grid-template-columns: 1fr;
        }
    }
</style>