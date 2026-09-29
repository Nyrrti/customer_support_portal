<script setup lang="ts">
    import { onMounted, computed } from "vue";
    import { useRouter } from "vue-router";
    import Form from "../components/Form.vue";
    import { userStore } from "../store.js"
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import type { User, CreateUser } from "../types.js";

    const router = useRouter();
    
    const createUser = async (data: CreateUser) => {
        await userStore.actions.create(data);
        router.push({name: "user-overview"});
    };

    // Read the state
    const users = computed<User[]>(() =>
        Object.values(userStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch categories and put them into state
        await userStore.actions.getAll();
    });
</script>

<template>
    <LoggedInLayout>
        <div class="user-page-background">
            <div class="form-wrapper py-3">
                <Form :users="users" @submit="createUser" mode="create"/>
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .user-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }
</style>