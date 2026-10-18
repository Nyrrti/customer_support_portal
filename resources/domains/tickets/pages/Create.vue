<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { ticketStore } from "../store.js";
    import { categoryStore } from "../../categories/store.js"
    import { useRouter } from "vue-router";
    import type { CreateTicket } from "../types.js";
    import type { Category } from "../../categories/types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";

    const router = useRouter();
    
    const { errors, saving, submit, clearError } = useForm();
    const loading = ref(true);
    const loadFailed = ref(false);

    /**
     * Creates a ticket and opens the overview after a successful save.
     *
     * @param data - The ticket values submitted by the child form.
     */
    const createTicket = async (data: CreateTicket) => {
        const saved = await submit(
            () => ticketStore.actions.create(data)
        );

        if (saved) {
            await router.push({ name: "tickets-overview" });
        }
    };

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    /**
     * Loads the category options needed to create a ticket.
     */
    onMounted(async () => {
        try {
            await categoryStore.actions.getAll();
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });
</script>

<template>
    <LoggedInLayout>
        <div class="ticket-page-background">
            <div class="form-wrapper py-3">
                <section
                    v-if="loading || loadFailed || categories.length === 0"
                    class="ticket-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading categories</h2>
                        <p>Please wait while we prepare your ticket form.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load categories</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>No categories available</h2>
                        <p>
                            An administrator needs to add a category
                            before you can create a ticket.
                        </p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'tickets-overview' }"
                    >
                        Back to tickets
                    </RouterLink>
                </section>
                <Form
                    v-else 
                    mode="create"
                    :categories="categories" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="createTicket"
                    @dismiss-error="clearError" 
                />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .ticket-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }

    .ticket-state {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
    }

    .ticket-state h2 {
        margin: 0;
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .ticket-state p {
        margin: 0;
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .ticket-state a {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem;
        border-radius: 0.6rem;
    }
</style>