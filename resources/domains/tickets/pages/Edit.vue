<script setup lang="ts">
    import { ref, onMounted, computed } from 'vue';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store.js';
    import { categoryStore } from "../../categories/store.js"
    import { useRouter, useRoute } from 'vue-router';
    import type { Category } from '../../categories/types.js';
    import type { Ticket, UpdateTicket } from '../types.js';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';
    import { useForm } from '../../../js/composables/useForm.js';

    const route = useRoute();
    const router = useRouter();
    const { errors, saving, submit, clearError } = useForm();
    
    const loading = ref(true);
    const loadFailed = ref(false);

    const ticketId = Number(route.params.id);

    const ticket = computed<Ticket | undefined>(() =>
        ticketStore.getters.getById(ticketId).value
    );

    
    /**
     * Updates the ticket and opens the overview after a successful save.
     *
     * @param data - The updated values submitted by the child form.
     */
    const updateTicket = async (data: UpdateTicket) => {
        const saved = await submit(
            () => ticketStore.actions.update(ticketId, data)
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
     * Loads the selected ticket and category options before displaying the form.
     */
    onMounted(async () => {
        try {
            await Promise.all([
                ticketStore.actions.getOne(ticketId),
                categoryStore.actions.getAll(),
            ]);
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
                    v-if="loading || loadFailed || !ticket"
                    class="ticket-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading ticket</h2>
                        <p>Please wait while we load the details.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load ticket</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>Ticket unavailable</h2>
                        <p>This ticket may not exist, or you may not have access.</p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'tickets-overview' }"
                    >
                        Back to tickets
                    </RouterLink>
                </section>

                <Form 
                    v-else-if="ticket" 
                    mode="edit"
                    :ticket="ticket" 
                    :categories="categories"  
                    :errors="errors" 
                    :saving="saving"
                    @submit="updateTicket"
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
        color: var(--font-color-dark);
    }

    .ticket-state p {
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