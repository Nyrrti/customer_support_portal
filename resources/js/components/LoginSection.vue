<script setup lang="ts">
import LoginForm from './LoginForm.vue';

</script>


<template>
    <div class="login-section">
        <div class="login-content">
            <div class="login-heading">
                <h2>
                    Welcome back
                </h2>
            </div>
            <div class="login-card">
                <LoginForm />
            </div>
            <div class="register-card">
                Register section goes here
            </div>
        </div>
        
    </div>
</template>


<style scoped>
    .login-section {
        --login-padding: 3rem;
        --login-content-width: 28rem;
        --login-gap: 1.75rem;

        min-height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: var(--login-padding);
        background-color: var(--bg-color-secondary);
    }

    .login-content {
        width: 100%;
        max-width: var(--login-content-width);
        display: flex;
        flex-direction: column;
        gap: var(--login-gap);
    }

    .login-heading {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .login-card,
    .register-card {
        width: 100%;
    }
</style>