<script setup lang="ts">
    import { onMounted, ref } from "vue"
    import { useRoute } from "vue-router"
    import axios from "axios"

    const route = useRoute();
    const loading = ref(true);
    const error = ref(null);

    const ticket = ref(null);
    
    function formatDate(date: string): string {
        const formatted = new Intl.DateTimeFormat("en-GB", {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
        }).format(new Date(date))

        return formatted.replace(/\//g, "-")
    }

    async function fetchTicket() {
        loading.value = true

        try {
            const response = await axios.get(`/api/tickets/${route.params.id}`)

            ticket.value = response.data
        } catch (error) {
            error.value = "Could not load the ticket."
        } finally {
            loading.value = false
        }
    }
    
    onMounted(fetchTicket);

</script>

<template>
    <div v-if="loading">
        Loading ticket...
    </div>
    <div v-else-if="error">
        {{ error }}
    </div>
    <div v-else-if="ticket">
        <div class="ticket-nav">
            <RouterLink :to="{ name: 'dashboard' }">
                Tickets
            </RouterLink>
            > #{{ String(ticket.id).padStart(4, '0') }}
        </div>
        <section class="ticket-summary">
            
            <header class="ticket-summary-header">
                <div class="ticket-summary-number">
                    <div class="ticket-number">
                        <span>Ticket</span>
                        <strong>#{{ ticket.id }}</strong>
                    </div>
                </div>

                <div class="ticket-summary-subject">
                    <h1>{{ ticket.subject }}</h1>

                    <span class="badge status">
                        {{ ticket.status }}
                    </span>
                </div>

                <RouterLink :to="{ name: 'edit', params: { id: ticket.id } }" class="btn edit">
                   > Edit Ticket
                </RouterLink>
            </header>

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
                    <dd>{{ formatDate(ticket.created_at) }}</dd>
                </div>

                <div class="meta-item">
                    <dt>Last updated</dt>
                    <dd>{{ formatDate(ticket.updated_at) }}</dd>
                </div>

                <div class="meta-item">
                    <dt>Assigned to</dt>
                    <dd>{{ ticket.assigned_to?.name ?? "Not assigned yet" }}</dd>
                </div>
            </dl>

            <div class="ticket-summary-description">
                <h2>Description</h2>
                <p>{{ ticket.description }}</p>
            </div>  
        </section>
    </div>
</template>

<style scoped>

    .ticket-nav {
        padding: 0.75rem 0.5rem;
        color: var(--font-color-medium-dark);
    }

    .ticket-nav:hover a {
        color: var(--color-purple);
    }

    .ticket-summary {
        --gap: 1.5rem;
        --border-color-inside: #c7cbd4;
        --border-color-outside: #c0c2d2;

        overflow: hidden;
        border-radius: 0.6rem;
        background-color: var(--bg-color-card-dark);
        border: 1px solid var(--border-color-outside);
        box-shadow: 0 0.25rem 0.5rem rgba(15, 29, 51, 0.05);
    }

    .ticket-summary-header {
        display: grid;
        grid-template-columns:
            auto
            minmax(12rem, 1fr)
            auto;

        align-items: center;
        gap: var(--gap);
        padding-inline: 1.5rem;
    }

    .ticket-summary-subject {
        display: flex;
        align-items: center;
        gap: var(--gap);
        flex-wrap: wrap;
    }

    .ticket-summary-subject h1 {
        margin: 0;
    }

    .ticket-summary-header h1 {
        margin: 0;
        font-size: 1.25rem;
    }

    .ticket-summary-number {
        position: relative;
        z-index: 1;
        padding: 1.25rem 1.5rem;
        background: var(--bg-color-secondary);
        font-size: 1.35rem;
        font-weight: 700;
        transform: translateY(1rem);
        border: 1px solid var(--border-color-outside) ;
    }

     .ticket-number {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.15rem;
        padding: 0.25rem 1rem;
        background: var(--bg-color-secondary);
        border-left: 0.25rem solid var(--color-blue);
    }
    
    .ticket-number span {
        color: var(--font-color-medium-dark);
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .ticket-number strong {
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .ticket-summary-meta {
        display: flex;
        align-items: center;
        gap: 0;
        margin: 0;
        padding: 2rem 1.75rem 1.25rem;
        background: var(--bg-color-secondary);
        border-bottom: 1px solid var(--border-color-outside);
    }

    .meta-item {
        padding-inline: 2rem;
        border-right: 1px solid var(--border-color-inside);
    }

    .meta-item:first-child {
        padding-left: 0;
    }

    .meta-item:last-child {
        border-right: 0;
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

    .ticket-summary-description h2 {
        margin: 0 0 0.75rem;
        font-size: 1rem;
    }

    .ticket-summary-description p {
        margin: 0;
        line-height: 1.6;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.65rem;
        border-radius: 0.45rem;
        font-size: var(--font-size-caption);
        font-weight: 500;
    }

    .badge.status {
        background-color: color-mix(
            in srgb,
            var(--bg-color-card-dark) 80%,
            #6ccf8d
        );
        color: #4d7f5f;
        border: 1px solid #259343;
    }

</style>