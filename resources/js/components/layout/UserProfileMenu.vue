<script setup lang="ts">
    import { authStore } from '../../../domains/auth/store';
</script>



<template>

    <div class="profile-bg">
        <div class="profile-icons">
            <div class="icon">
                B
            </div>
            <div class="icon">
                ?
            </div>
        </div>
        <div class="user-profile">
            <div class="icon user">
                A
            </div>
            <div class="user">
                <div v-if="authStore.loading">
                    <h5>Loading...</h5>
                    <p>Loading...</p>
                </div>

                <div v-else-if="authStore.user">
                    <h5>{{ authStore.user.name }}</h5>
                    <p>
                        {{ authStore.user.is_admin ? "Administrator" : "User" }}
                    </p>
                </div>
                <h5>
                    &#128899;
                </h5>  
            </div> 
        </div>
    </div>


</template>

<style scoped>

    .profile-bg {
        --profile-gap: 2rem;
        --icon-gap: 1.1rem;

        margin-left: auto;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: var(--profile-gap);
    }

    .profile-icons {
        display: flex;
        gap: var(--icon-gap);
    }

    .icon {
        width: 2.2rem;
        height: 2.2rem;
        background-color: transparent;
        color: var(--font-color-medium-light);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--icon-gap);
        border: 2px solid var(--font-color-medium-light);
        border-radius: 1.5rem;
    }

    .icon.user {
        width: 2.8rem;
        height: 2.8rem;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        border: 0;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: var(--icon-gap);
    }
    
    .user {
        display: flex;
        align-items: center;
        gap: var(--icon-gap);
    }

    .user-profile h5 {
        color: var(--font-color-light);
    }

    .user-profile p {
        color: var(--font-color-medium-light);
        font-size: var(--text-caption);
        line-height: 0.85rem;
    }
</style>