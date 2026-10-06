<script setup lang="ts">
    import { computed, onMounted } from "vue";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import UserOverview from "../components/UserOverview.vue"
    import { userStore } from "../store.js";
    import type { User } from "../types.js";

    // Read the state
    const users = computed<User[]>(() =>
        Object.values(userStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch users and put them into state
        await userStore.actions.getAll();
    }); 
</script>

<template>

    <LoggedInLayout>
        <div class="user-page-background">
            <UserOverview 
                :users="users"
                :deleting="deleting"
                @delete="deleteUser" 
            />
            
        </div> 
    </LoggedInLayout>

</template>

<style scoped>

    .user-page-background {
        min-height: 100%;
        background-color: var(--bg-color-dark-blue);
        padding: 1rem;
    }

     @media (min-width: 1200px) {

        .User-page-background {
            padding: 1.5rem;
        }
    }

</style>