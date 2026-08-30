<script setup lang="ts">
const tickets = [
    {
        id: '#1008',
        subject: 'Unable to login',
        category: 'Account Access',
        status: 'Open',
        updated: '5m ago',
        assignedTo: 'Olivia Rhye',
    },
    {
        id: '#1007',
        subject: 'Payment not going through',
        category: 'Payments',
        status: 'In Progress',
        updated: '15m ago',
        assignedTo: 'Liam Steiner',
    },
    {
        id: '#1006',
        subject: 'Feature request: Dark mode',
        category: 'Feature Request',
        status: 'Pending',
        updated: '1h ago',
        assignedTo: 'Demi Wilkinson',
    },
    {
        id: '#1005',
        subject: 'How to export reports?',
        category: 'Reports',
        status: 'Open',
        updated: '2h ago',
        assignedTo: 'Candice Wu',
    },
];
</script>

<template>
    <section class="overview-panel">
        <div class="overview-card">
            <div class="overview-header">
                <div class="overview-title-group">
                    <div class="overview-icon">
                        T
                    </div>

                    <h3>
                        Ticket Overview
                    </h3>
                </div>
                <div class="d-flex gap-1">
                    <button class="btn ticket">
                       + Create Ticket
                    </button>
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
                        <tr v-for="ticket in tickets" :key="ticket.id">
                            <td class="title-bold">
                                {{ ticket.id }}
                            </td>
                            <td>{{ ticket.subject }}</td>
                            <td>
                                <span class="pill category">
                                    {{ ticket.category }}
                                </span>
                            </td>
                            <td>
                                <span class="pill status">
                                    {{ ticket.status }}
                                </span>
                            </td>
                            <td>{{ ticket.updated }}</td>
                            <td>{{ ticket.assignedTo }}</td>
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

        border: 1px solid var(--table-border);
        border-radius: 0.6rem;
    }

    .title-bold {
        font-weight: 500;
    }

    .ticket-table {
        width: 100%;
        border-collapse: collapse;

        background-color: var(--table-bg);
    }

    .ticket-table thead {
        background-color: color-mix(
            in srgb,
            var(--table-bg) 95%,
            var(--font-color-medium-dark)
        );
    }

    .ticket-table th {
        padding: 0.9rem 0.75rem;

        text-align: left;

        color: var(--table-text-muted);
        font-size: var(--font-size-xxs);
        font-weight: 600;

        border-bottom: 1px solid var(--table-border);
    }

    .ticket-table td {
        padding: 1rem 0.75rem;

        color: var(--table-text);
        font-size: var(--font-size-xs);

        background-color: transparent;
        border-bottom: 1px solid var(--table-border);
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
            var(--table-bg) 96%,
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
        background-color: color-mix(in srgb, var(--color-blue) 18%, white);
        color: var(--color-blue);
    }

    .pill.status {
        background-color: color-mix(in srgb, #6ccf8d 18%, white);
        color: #3b8f59;
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