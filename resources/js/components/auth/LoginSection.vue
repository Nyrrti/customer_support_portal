<script setup lang="ts">
    import LoginForm from './LoginForm.vue';
    import RegisterPrompt from './RegisterPrompt.vue';
</script>


<template>
    <div class="login-section">
        <div class="login-content">
            <div class="login-heading">
                <h2>
                    Welcome back
                </h2>
            </div>
            <div class="login-form">
                <LoginForm />
            </div>
            
            <RegisterPrompt />
            
        </div>
        
    </div>
</template>


<style scoped>
    .login-section {
        --login-padding: 3rem;
        --login-content-width: 28rem;
        
        min-height: 100%;
        display: flex;
        justify-content: center;
        padding: var(--login-padding);
        background-color: var(--bg-color-secondary);
        background:
        linear-gradient(
            135deg,
            var(--bg-color-secondary),
            color-mix(in srgb, var(--bg-color-secondary) 85%, rgb(92, 119, 153))
        );   
    }

    .login-heading {
        margin-bottom: 0.8rem;
    }

    .login-form {
        margin-bottom: 1.75rem;
    }

    .login-content {
        width: 100%;
        max-width: var(--login-content-width);
        display: flex;
        flex-direction: column;
    }

    .login-card,
    .register-card {
        width: 100%;
    }

    /* Very large Screens */
    @media (min-width: 1600px) {
        .login-section {
            --login-padding: 4rem;
        }
        
        .login-content {
            margin-top: 1rem;
        }
    }
</style>