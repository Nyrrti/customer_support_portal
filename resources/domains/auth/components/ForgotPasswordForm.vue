<script setup lang="ts">
    import { ref } from "vue";
    import { useRouter } from "vue-router";
    import { authStore } from "../store";
    import { useForm } from "../../../js/composables/useForm";
    import FieldError from "../../../js/components/FieldError.vue";

    const router = useRouter();
    const { errors, saving, submit, clearError } = useForm();

    const form = ({
        email: ""
    });
</script>

<template>
    <form @submit.prevent="" class="forgot-password-bg p-4 mt-5">
        <div class="forgot-password-heading py-2">
            <div class="forgot-password-icon">
                F
            </div>
            <div>
                <h5>
                    Forgot your password?
                </h5>
                <p>
                    Enter your email and we'll sort you out.
                </p>
            </div>
        </div>
        <div class="forgot-password-input-field">
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
        </div>
        <div class="bottom-row">
            <button class="btn forgot-password" type="submit" :disabled="saving">
                {{ saving ? "Sending email..." : "Send email" }}
            </button>
            <p class="login-link">
                Already have an account?
                <RouterLink :to="{ name: 'home' }">Log in</RouterLink>
            </p>
        </div>
    </form>
</template>

<style scoped>

    .forgot-password-bg {
        align-self: start;
        background-color: var(--bg-color-card);
        border-radius: 0.6rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
    }

    .forgot-password-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .forgot-password-heading p {
        color: var(--font-color-medium-dark);
        font-size: var(--text-body);
    }

    .forgot-password-icon {
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

    .forgot-password-input-field {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    .name-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.65rem;
    }

    .forgot-password-input-field input {
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

    .btn.forgot-password {
        width: 100%;
        background-color: var(--color-purple);
        color: var(--font-color-light);
        padding-block: 0.75rem;
    }

    .btn.forgot-password:disabled {
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