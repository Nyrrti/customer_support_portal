<script setup lang="ts">
    import { computed, onMounted, ref } from "vue";
    import TicketsOverview from "../components/TicketsOverview.vue";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { ticketStore } from "../store";
    import type { Ticket } from "../types";

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


