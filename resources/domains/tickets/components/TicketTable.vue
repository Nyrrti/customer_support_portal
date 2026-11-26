<script setup lang="ts">
    import type { Ticket, TicketStatus } from "../types"
    import CheckTime from "../../../js/components/CheckTime.vue";
    import TicketStatusPill from "../../../js/components/TicketStatusPill.vue";

    /** Display labels for the API's status values. */
    const statusLabels: Record<TicketStatus, string> = {
        pending: "Pending",
        open: "Open",
        closed: "Closed"
    };

    defineProps<{
        tickets: Ticket[];
    }>();

    const emit = defineEmits<{
        (event: "actions", ticket: Ticket): void;
    }>();

    const formatDate = (date: string) => {
        if (!date) return '';

        return new Date(date).toLocaleDateString('en-GB').replace(/\//g, '-');
    };
</script>

<template>
    <div class="overview-table-wrap">
        <table class="ticket-table">
            <colgroup>
                <col class="table-w-5"> <!-- ID -->
                <col> <!-- Subject -->
                <col class="table-w-15"> <!-- Category -->
                <col class="table-w-10"> <!-- Status -->
                <col class="table-w-12"> <!-- Created By -->
                <col class="table-w-11"> <!-- Created -->
                <col class="table-w-11"> <!-- Updated -->
                <col class="table-w-15"> <!-- Assigned to -->
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Assigned To</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="ticket in tickets" :key="ticket.id">
                    <td class="title-bold muted">
                        #{{ String(ticket.id).padStart(3, '0') }}
                    </td>

                    <td>
                        <RouterLink
                            class="ticket-link"
                            :to="{
                                name: 'ticket-detail',
                                params: { id: ticket.id },
                            }"
                        >
                            {{ ticket.title }}
                        </RouterLink>
                    </td>

                    <td>
                        <span class="pill category">
                            {{ ticket.category?.title }}
                        </span>
                    </td>

                    <td>
                        <TicketStatusPill :status="ticket.status" />
                    </td>
                    <td>
                        {{ ticket.created_by.name}}
                    </td>
                    <td class="small-muted">
                        {{ formatDate(ticket.created_at) }}
                    </td>
                    <td class="small-muted">
                        <CheckTime :date="ticket.updated_at" />
                    </td>

                    <td class="assigned">
                        {{ ticket.assigned_to?.name ?? "Not assigned yet" }}
                    </td>
                </tr>

                <tr v-if="tickets.length === 0">
                    <td colspan="7" class="text-center">
                        No tickets found.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>

    .overview-table-wrap {
        --border-ticket-table: #426db2;
        --border-id: #bdc4cf;

        overflow-x: auto;
        border-radius: 0.6rem;
        border: 1px solid var(--border-ticket-table);
        min-height: 100%;
    }

    .ticket-link {
        color: var(--font-color-dark);
        text-decoration: none;
    }

    .ticket-link:hover {
        text-decoration: underline;
    }

    .ticket-link:focus-visible {
        outline: 2px solid var(--color-blue);
        outline-offset: 3px;
    }

     .title-bold {
        font-weight: 500;
    }

    .ticket-table {
        width: 100%;
        border-collapse: collapse;
        /* background-color: var(--table-bg); */
    }

    .ticket-table td:first-child,
    .ticket-table td:nth-child(4),
    .ticket-table td:nth-child(6),
    .ticket-table td:nth-child(7),
    .ticket-table td:last-child {
        white-space: nowrap;
    }

    .ticket-table thead {
        background-color: var(--table-header);
    }

    .ticket-table th {
        padding: 1.2rem 0.7rem;
        text-align: left;
        color: var(--font-color-medium-light);
        font-size: var(--text-label);
        letter-spacing: var(--table-letter-spacing);
        font-weight: 500;
        border-bottom: 1px solid var(--table-border);
    }

    .ticket-table td {
        padding: 1rem 0.7rem;
        color: var(--table-text);
        font-size: var(--text-table);
        letter-spacing: var(--table-letter-spacing);
        background-color: transparent;
        border-bottom: 1px solid var(--table-border);
    }

    .title-bold.muted {
        color: var(--table-text-muted);
    }

    .ticket-table td.small-muted {
        color: var(--font-color-medium-dark);
        font-size: var(--text-caption);
    }

    .ticket-table thead th:first-child {
        text-align: center;
    }

    .ticket-table tbody td:first-child {
        text-align: center;
        font-size: var(--text-caption);
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
        font-size: var(--text-caption);
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

</style>