<script setup lang="ts">

</script>

<template>
    <div class="register-bg p-4">
        <div class="register-content">
            <div class="register-icon">
                R
            </div>
            <div>
                <h5>New to TicketyTicker?</h5>
                <p>
                    Create an account to submit and track your support tickets.
                </p>
            </div>
        </div>
        <button class="btn register">
            Create account
        </button>
    </div>
</template>

<style scoped>
    .register-bg {
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-color);
        border-radius: 0.6rem;
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .register-content {
        display: flex;
        justify-content: space-between;
        align-items: start;
        gap: 2rem;
    }

    .register-content p {
        margin-top: 0.25rem;
        color: var(--font-color-medium-dark);
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

    .btn.register {
        background-color: transparent;
        border: 3px solid var(--color-purple);
        color: var(--font-color-title-dark);
        width: 100%;
        padding: 0.5rem;
    }

    .btn.register:hover {
        background-color: color-mix(
            in srgb,
            var(--color-purple) 80%,
            black
        );
        color: var(--font-color-light);
    }
</style>