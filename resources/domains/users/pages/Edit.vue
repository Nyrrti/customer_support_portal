<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { userStore } from "../store.js";
    import { useRouter, useRoute } from "vue-router";
    import type { User, UpdateUser } from "../types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";
   

    const route = useRoute();
    const router = useRouter();
   
    const { errors, saving, submit, clearError } = useForm();
    const loading = ref(true);
    const loadFailed = ref(false);

    const userId = Number(route.params.id);

    const user = computed<User | undefined>(() =>
        userStore.getters.getById(userId).value
    );

    const updateUser = async (data: UpdateUser) => {
        const saved = await submit(
            () => userStore.actions.update(userId, data)
        );

        if (saved) {
            await router.push({ name: "users-overview" });
        }
    };

    onMounted(async () => {
        try {
            await userStore.actions.getOne(userId);
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });

</script>

<template>
    <LoggedInLayout>
        <div class="user-page-background">
            <div class="form-wrapper py-3">
                <section
                    v-if="loading || loadFailed || !user"
                    class="user-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading user</h2>
                        <p>Please wait while we load the details.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load user</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>User not found</h2>
                        <p>This user may have been deleted.</p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'users-overview' }"
                        class="user-state-link"
                    >
                        Back to Users
                    </RouterLink>
                </section>

                <Form 
                    v-else-if="user"
                    mode="edit"
                    :user="user" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="updateUser"
                    @dismiss-error="clearError" 
                />
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

    .user-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
    }

    .user-state h2 {
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .user-state p {
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .user-state-link {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem 1.25rem;
        border-radius: 0.6rem;
    }

    .user-state-link:focus-visible {
        outline: 2px solid var(--color-yellow);
        outline-offset: 3px;
    }
</style>