<script setup lang="ts">
    import { onMounted, computed } from "vue";
    import { ticketStore } from "../store";
    import TicketTable from "../components/TicketTable.vue";
    import TicketCard from "./TicketCard.vue";
    import type { Ticket } from "../types";
    import SearchFilter from "../../../js/components/SearchFilter.vue";

    // Read the state
    const tickets = computed<Ticket[]>(() =>
        Object.values(ticketStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch tickets and put them into state
        await ticketStore.actions.getAll();
    }); 
</script>

<template>
    <section class="overview-panel">
        <div class="overview-card">
            <div class="overview-header py-3">
                <div class="title-section pt-1 pb-4">
                    <div class="overview-title">
                        <div class="overview-icon">
                            T
                        </div>
                        <h3 class="light">
                            All Tickets
                        </h3>
                    </div>
                    <div class="overview-ticket-button">
                        <RouterLink :to="{name: 'create-ticket'}" class="btn ticket">
                            + New Ticket
                        </RouterLink>
                    </div>
                </div>
                <SearchFilter />
            </div>
            <div class="mobile">
                <TicketCard :tickets="tickets" />
            </div>
            <div class="desktop">
                <TicketTable :tickets="tickets" />
            </div>
            
            <div class="overview-footer">
                <p>
                    Showing {{ tickets.length }} tickets
                </p>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .overview-panel {
        min-height: 100%;
        background-color: var(--bg-color-blue);
    }

    .overview-card {
        padding: 1rem;
    }

    .overview-header {
        flex-direction: column;
        align-items: stretch;
    }

    .overview-ticket-button {
        display: flex;
        gap: var(--space-2);
    }

    .overview-ticket-button > .btn {
        flex: 1;
        min-width: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .title-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .overview-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .overview-icon {
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.65rem;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        font-weight: 700;
    }

    .overview-footer {
        margin-top: 1.25rem;
    }

    .overview-footer p {
        color: var(--font-color-medium-light);
    }

    .btn.filter {
        background-color: transparent;
        border: 2px solid var(--border-color-blue);
        color: var(--font-color-medium-light);
    }

    .btn.filter:hover {
        background-color: var(--border-color-darker);
    }

    .btn.ticket {
        background-color: var(--color-yellow);
        color: var(--font-color-dark);
        padding: 0.8rem 2rem;
    }

    .btn.ticket:hover {
        background-color: color-mix(in srgb, var(--color-yellow) 85%, black); 
    }

    .mobile {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .desktop {
        display: none;
    }

    @media (min-width: 768px) {

        .overview-actions > .btn {
            flex: initial;
        }
    }

    @media (min-width: 1200px) {

        .overview-card {
            padding: 1.5rem;
        }

        .mobile {
            display: none;
        }

        .desktop {
            display: block;
        }

        .overview-title {
            padding-bottom: 0;
        }

        .overview-ticket-button {
            width: auto;
            flex: 0 0 auto;
        }

        .overview-ticket-button > .btn {
            flex: 0 0 auto;
            width: auto;
        }
    }
</style>