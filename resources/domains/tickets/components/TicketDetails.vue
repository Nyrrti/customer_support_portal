<script setup lang="ts">
    import { onMounted } from "vue";
    import { ticketStore } from "../store";
    import { useRoute } from "vue-router";
    import CheckTime from "../../../js/components/CheckTime.vue";

    const route = useRoute();
   
    // Read the state
    const ticket = ticketStore.getters.getById(Number(route.params.id));

    onMounted(async () => {
        // Fetch tickets and put them into state
        await ticketStore.actions.getAll();
    }); 
</script>

<template>
    <div class="ticketdetail-section">
        <div v-if="ticket" :key="ticket.id">
            <div class="ticket-nav">
                <RouterLink :to="{ name: 'tickets-overview' }">
                    Tickets
                </RouterLink>
                > #{{ String(ticket.id).padStart(4, '0') }}
            </div>
            <section class="ticket-summary"> 
                <header class="ticket-summary-header">
                    <div class="ticket-summary-number">
                        <div class="ticket-number">
                            <span>Ticket</span>
                            <strong>#{{ String(ticket.id).padStart(3, '0') }}</strong>
                        </div>
                    </div>
                    <RouterLink :to="{ name: 'edit-ticket', params: { id: ticket.id } }" class="btn edit">
                        > Edit Ticket
                    </RouterLink>
                </header>
                <div class="ticket-subject">
                    <h3>{{ ticket.title }}</h3>
                </div>
                <dl class="ticket-summary-meta">
                    
                    <div class="meta-item">
                        <dt>Category</dt>
                        <dd>{{ ticket.category?.title }}</dd>
                    </div>

                    <div class="meta-item">
                        <dt>Created by</dt>
                        <dd>{{ ticket.created_by.name }}</dd>
                    </div>

                    <div class="meta-item">
                        <dt>Created</dt>
                        <dd>
                            <CheckTime :date="ticket.created_at" />
                        </dd>
                    </div>

                    <div class="meta-item">
                        <dt>Last updated</dt>
                        <dd>
                            <CheckTime :date="ticket.updated_at" />
                        </dd>
                    </div>

                    <div class="meta-item">
                        <dt>Assigned to</dt>
                        <dd>{{ ticket.assigned_to?.name ?? "Not assigned yet" }}</dd>
                    </div>

                    <div class="meta-item">
                        <dt>Status</dt>
                        <dd>
                            {{ ticket.status }} 
                        </dd>
                    </div>
                </dl>

                <div class="ticket-summary-description">
                    <h4>Description</h4>
                    <p>{{ ticket.description }}</p>
                </div>  
            </section>
        </div>
        <p v-else>Loading ticket…</p>
    </div>
</template>

<style scoped>

    .ticketdetail-section {
        --card-border: #3b68a5;
        --ticket-card-border-dark: #597db1;
        --bg-ticket-card: #2d5690;

        min-height: 100%;
        background-color: var(--bg-color-dark-blue);
        padding: 0.5rem;
    }

    .ticket-nav {
        padding: 0.75rem 0.5rem;
        color: var(--font-color-medium-light);
    }

    .ticket-nav a {
        color: var(--font-color-title-light);
    }

    .ticket-nav:hover a {
        color: var(--color-yellow);
    }

    .ticket-summary {
        --gap: 1.35rem;
        --border-color-inside: #c7cbd4;
        --border-color-outside: #c0c2d2;

        overflow: hidden;
        border-radius: 0.6rem;
        background-color: var(--bg-color-card-dark);
        border: 1px solid var(--card-border);
        box-shadow: 0 0.25rem 0.5rem rgba(15, 29, 51, 0.05);
    }

    .ticket-summary-header {
        background-color: var(--bg-ticket-card);
        background: linear-gradient(
            110deg,
            #1b4682,
            #244e88 50%,
            #2d5690 100%
        );
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: var(--gap);
        padding-inline: 1.5rem;
    }

    .ticket-summary-number {
        position: relative;
        z-index: 1;
        padding: 1.1rem 1.5rem;
        background: var(--bg-ticket-card);
        font-size: 1.35rem;
        font-weight: 700;
        transform: translateY(1rem);
    }

     .ticket-number {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.1rem;
        padding: 0.25rem 1rem;
        border-left: 0.25rem solid var(--color-blue);
    }
    
    .ticket-number span {
        color: var(--font-color-medium-light);
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .ticket-number strong {
        color: var(--font-color-medium-light);
        font-size: 1.25rem;
        font-weight: 700;
    }

    .ticket-subject {
        background: var(--bg-ticket-card);
        display: flex;
        align-items: center;
        gap: var(--gap);
        flex-wrap: wrap;
        padding: 1.25rem;
        padding-top: 1.5rem;
    }

    .ticket-subject h3 {
        color: var(--color-yellow);
        font-size: 1.4rem;
    }

    .ticket-summary-meta {
        display: grid;
        justify-content: center;
        grid-template-columns:
            auto
            auto;
        column-gap: 2rem;
        row-gap: 0.75rem;
        padding: 1rem;
    }

    .meta-item {
        padding: 0.25rem;
    }

    .meta-item dt {
        color: var(--font-color-medium-dark);
        font-size: 0.8rem;
    }

    .meta-item dd {
        margin: 0.25rem 0 0;
        color: var(--font-color-dark);
        font-weight: 500;
    }

    .ticket-summary-description {
        min-height: 8rem;
        padding: 1.5rem 1.75rem;
        background: var(--bg-color-card);
    }

    .ticket-summary-description p {
        margin-block: 0.3rem;
        line-height: 1.6;
    }


     @media (min-width: 1200px) {

        .ticketdetail-section {
            padding: 1.5rem;
        }
    }
</style>