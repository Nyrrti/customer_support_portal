<script setup lang="ts">
    import { onMounted } from 'vue';
    import { fetchTickets, getAllTickets } from '../ticketstore';

    function formatDate(date: string): string {
        const formatted = new Intl.DateTimeFormat('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        }).format(new Date(date))

        return formatted.replace(/\//g, '-')
    }

    fetchTickets();
</script>

<template>
    <section class="overview-panel">
        <div class="overview-card">
            <div class="overview-header py-3">
                <div class="overview-title-group">
                    <div class="overview-icon">
                        T
                    </div>

                    <h3>
                        Ticket Overview
                    </h3>
                </div>
                <div class="d-flex gap-1">
                    <RouterLink :to="{name: 'tickets.create'}" class="btn ticket">
                        + New Ticket
                    </RouterLink>
                    <button class="btn filter">
                    &#9947; Filter
                    </button>
                </div>
            </div>

            <div class="overview-table-wrap">
                <table class="ticket-table">
                        <colgroup>
                            <col class="table-w-8">
                            <col class="">
                            <col class="table-w-15">
                            <col class="table-w-15">
                            <col class="table-w-12">
                            <col class="table-w-15">
                            <col class="table-w-5">
                        </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Updated</th>
                            <th>Assigned To</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="ticket in getAllTickets" :key="ticket.id">
                            <td class="title-bold">
                                #{{ ticket.id }}
                            </td>
                            <td>
                                
                                {{ ticket.subject }}
                                
                            </td>
                            <td>
                                <span class="pill category">
                                    {{ ticket.category.title }}
                                </span>
                            </td>
                            <td>
                                <span class="pill status">
                                    {{ ticket.status }}
                                </span>
                            </td>
                            <td class="updated">
                                {{ formatDate(ticket.updated_at) }}
                            </td>
                            <td>
                                {{ ticket.assigned_to?.name }}
                            </td>
                             <td class="actions-cell">
                                <button
                                    class="actions-button"
                                    type="button"
                                    aria-label="Ticket actions"
                                >
                                    ⋮
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overview-footer">
                <p>
                    Showing 1 to 4 of 42 tickets
                </p>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .overview-panel {
        --overview-panel-padding: 0.3rem;
        --overview-panel-radius: 1rem;

        background-color: var(--bg-color-secondary);
        border-radius: var(--overview-panel-radius);
    }

    .overview-card {
        --overview-card-padding: 1.5rem;
        --overview-card-radius: 0.85rem;

        background-color: var(--bg-color-card);
        border: 1px solid var(--border-color-darker);
        border-radius: var(--overview-card-radius);
        padding: var(--overview-card-padding);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
    }

    .overview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .overview-title-group {
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

    .overview-table-wrap {
        overflow-x: auto;
        border-radius: 0.6rem;
        border: 1px solid color-mix(
            in srgb,
            var(--table-border) 85%,
            transparent
        );
    }

    .title-bold {
        font-weight: 500;
    }

    .ticket-link {
        color: var(--table-link);
        font-size: var(--font-size-xs);
    }

    .ticket-link:hover {
        text-decoration: underline;
    }

    .ticket-table {
        width: 100%;
        border-collapse: collapse;
        background-color: var(--table-bg);
    }

    .ticket-table thead {
        background-color: color-mix(
            in srgb,
            var(--table-bg) 97%,
            var(--font-color-medium-dark)
        );
    }

    .ticket-table th {
        padding: 1rem 0.75rem;
        text-align: left;
        color: var(--table-text-muted);
        font-size: var(--font-size-xxs);
        font-weight: 500;
        border-bottom: 1px solid var(--table-border);
    }

    .ticket-table td {
        padding: 1rem 0.75rem;
        color: var(--table-text);
        font-size: var(--font-size-xs);
        background-color: transparent;
        border-bottom: 1px solid var(--table-border);
    }

    .ticket-table td.updated {
        color: var(--font-color-medium-dark);
        font-size: var(--font-size-xxs);
    }

    .ticket-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .ticket-table tbody tr:nth-child(odd) {
        background-color: var(--table-bg);
    }

    .ticket-table tbody tr:nth-child(even) {
        background-color: color-mix(
            in srgb,
            var(--table-bg) 98%,
            var(--color-grey)
        );
    }

    .ticket-table tbody tr:hover {
        background-color: var(--table-row-hover);
    }

    .pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 0.65rem;
        border-radius: 0.45rem;
        font-size: var(--font-size-caption);
        font-weight: 500;
    }

    .pill.category {
        background-color: color-mix(
            in srgb,
            var(--bg-color-card) 85%,
            var(--color-blue)
        );

        color: color-mix(
            in srgb,
            var(--font-color-dark) 30%,
            var(--color-blue)
        );
    }

    .pill.status {
        background-color: color-mix(
            in srgb,
            var(--bg-color-card) 84%,
            #6ccf8d
        );

        color: #4d7f5f;
    }

    .overview-footer {
        margin-top: 1.25rem;
    }

    .overview-footer p {
        color: var(--font-color-medium-dark);
    }

    .actions-cell {
        text-align: center;
    }

    .actions-button {
        width: 2rem;
        height: 2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        background: transparent;
        border: 0;
        border-radius: 0.4rem;
        color: var(--font-color-medium-dark);
        font-size: var(--font-size-lg);
        cursor: pointer;
    }

    .actions-button:hover {
        background-color: var(--table-row-hover);
        color: var(--font-color-dark);
    }

    .btn.filter {
        background-color: transparent;
        border: 1px solid var(--border-color-darker);
        color: var(--font-color-medium-dark);
    }

    .btn.filter:hover {
        background-color: var(--border-color-darker);
    }

    .btn.ticket {
        background-color: var(--color-yellow);
        color: var(--font-color-dark);
    }

    .btn.ticket:hover {
        background-color: color-mix(in srgb, var(--color-yellow) 85%, black); 
    }
</style>