<script setup lang="ts">
    import { ref } from 'vue';
    import {authStore} from "../../auth/store"
    import { useRouter } from 'vue-router';

    const router = useRouter();
    const email = ref<string>("");
    const password = ref<string>("");
    const remember = ref(false);

    async function handleLogin() {
        const success = await authStore.login(
            email.value,
            password.value
        );
        
        if (success) {
            await router.push("/tickets");
        }
    }

    async function handleLogout() {
        await authStore.logout();

        router.push("/");
    }


</script>

<template>
    <div v-if="authStore.user === null">
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
            <div class="login-input-field">
                <div class="field">
                    <label for="email">
                        Email address
                    </label>
                    <input 
                        id="email"
                        v-model="email"
                        type="email"
                        autocomplete="email"
                        required
                    >
                </div>
                <div class="field">
                    <label for="password">
                        Password
                    </label>
                    <input 
                        id="password"
                        v-model="password"
                        type="password"
                        autocomplete="current-password"
                        required
                    >
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
                    <a href="/" class="dark">Forgot password?</a>
                </div>
                <button class="btn login" type="submit">
                    Login
                </button> 
            </div>
            
        </form>
    </div>
    <div v-else>
        <h2>
            Welcome, {{ authStore.user.name }}
        </h2>
        <button @click="handleLogout" class="btn">
            Logout
        </button>
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
</style>