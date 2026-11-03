<script setup lang="ts">
    import { ref, computed, onMounted } from "vue";
    import TicketsOverview from "../../domains/tickets/components/TicketsOverview.vue";
    import LoggedInLayout from "../layouts/LoggedInLayout.vue";
    import { ticketStore } from "../../domains/tickets/store.js";
    import type { Ticket } from "../../domains/tickets/types.js";

    const loading = ref(true);
    const loadFailed = ref(false);

    const tickets = computed<Ticket[]>(() =>
        Object.values(ticketStore.getters.all.value)
    );

    /**
     * Loads the tickets available to the current user.
     */
    onMounted(async () => {
        try {
            await ticketStore.actions.getAll();
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });
</script>


<template>

    <LoggedInLayout>
        <TicketsOverview
            :tickets="tickets"
            :loading="loading"
            :load-failed="loadFailed"
        />    
    </LoggedInLayout>

</template>

<style scoped>

</style>
