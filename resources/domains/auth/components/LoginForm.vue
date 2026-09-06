<script setup lang="ts">
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import type { User } from "../types";
    import { useRouter } from 'vue-router';

    const router = useRouter();
    const email = ref('');
    const password = ref('');
    const remember = ref(false);

    const user = ref<User | null>(null);

    /**
     * Login
     */
    async function login() {
        try {
            await axios.get("/sanctum/csrf-cookie");

            const response = await axios.post("/login", {
                email: email.value,
                password: password.value,
            });

            await getUser();
            await router.push('/tickets');
        } catch (error) {
            if (axios.isAxiosError(error)) {
                if (error.response?.status === 422) {
                    console.log(error.response?.data.errors);
                }

                if (error.response?.status === 401) {
                    console.log(error.response?.data.message ?? "");
                }
            }
        }
    }

    /**
     * Get the current logged in user
     */
    async function getUser() {
        try {
            const response = await axios.get("/api/user");
            user.value = response.data;
        } catch (error) {
            if (axios.isAxiosError(error) && error.response?.status === 401) {
                user.value = null;
                return;
            }

            console.error("Could not get user:", error);
        }
    }

     /**
     * Logout
     */
    async function logout() {
        try {
            await axios.post("/logout");
            console.log("Logout successful");
            user.value = null;
            await router.push('/');
        } catch (error) {
            console.error("Logout failed:", error);
        }
    }

    onMounted(() => {
        getUser();
    });
</script>

<template>
    <div v-if="user === null">
        <form @submit.prevent="login" class="login-bg p-4">
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
            <div class="bottom-row my-3">
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
        </form>
    </div>
    <div v-else>
        <h2>
            Welcome, User
        </h2>
        <button @click="logout" class="btn">
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
        font-size: var(--font-size-xxs);
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
        gap:0.5rem;
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
        justify-content: space-between;
        align-items: center;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .bottom-row a {
        font-size: var(--font-size-xxs);
        color: var(--color-blue);
        font-weight: 500;
    }

    .btn.login {
        width: 100%;
    }
</style>