<script setup lang="ts">
    import { ref, onMounted, computed } from 'vue';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store.js';
    import { categoryStore } from "../../categories/store.js"
    import { useRouter, useRoute } from 'vue-router';
    import type { Category } from '../../categories/types.js';
    import type { Ticket } from '../types.js';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';

    const route = useRoute();
    const router = useRouter();
   
    const ticketId = Number(route.params.id);

    const ticket = computed<Ticket | undefined>(() =>
        ticketStore.getters.getById(ticketId).value
    );

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    const updateTicket = async (data: Ticket) => {
        await ticketStore.actions.update(ticketId, data);
        router.push({ name: 'dashboard' });
    };

    onMounted(async () => {
        await Promise.all([
            ticketStore.actions.getAll(),
            // Fetch categories and put them into state
            categoryStore.actions.getAll(),
        ]);
        console.log(ticket.value);
    });

</script>

<template>
    <LoggedInLayout>
        <div class="ticket-page-background">
            <div class="form-wrapper py-3">
                <Form v-if="ticket" 
                    :ticket="ticket" 
                    :categories="categories"  
                    mode="edit"
                    @submit="updateTicket" 
                />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .ticket-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-secondary);
        background:
        linear-gradient(
            135deg,
            var(--bg-color-secondary),
            color-mix(in srgb, var(--bg-color-secondary) 95%, rgb(92, 119, 153))
        );
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }
</style>