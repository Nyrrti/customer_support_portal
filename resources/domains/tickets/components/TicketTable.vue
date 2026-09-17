<script setup lang="ts">
    import type { Ticket } from "../types"
    import CheckTime from "../../../js/components/CheckTime.vue";

    defineProps<{
        tickets: Ticket[];
    }>();

    const emit = defineEmits<{
        (event: "actions", ticket: Ticket): void;
    }>();

</script>

<template>
    <div class="overview-table-wrap">
        <table class="ticket-table">
            <colgroup>
                <col class="table-w-7">
                <col>
                <col class="table-w-15">
                <col class="table-w-12">
                <col class="table-w-12">
                <col class="table-w-18">
                <col class="table-w-5">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Updated</th>
                    <th scope="col">Assigned To</th>
                    <th scope="col" aria-label="Actions"></th>
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
                            {{ ticket.subject }}
                        </RouterLink>
                    </td>

                    <td>
                        <span class="pill category">
                            {{ ticket.category?.title }}
                        </span>
                    </td>

                    <td>
                        <span class="pill status">
                            {{ ticket.status }}
                        </span>
                    </td>

                    <td class="updated">
                        <CheckTime :date="ticket.updated_at" />
                    </td>

                    <td class="assigned">
                        {{ ticket.assigned_to?.name ?? "Not assigned yet" }}
                    </td>

                    <td class="actions-cell">
                        <button
                            class="actions-button"
                            type="button"
                            :aria-label="`Actions for ticket ${ticket.id}`"
                            @click="emit('actions', ticket)"
                        >
                            ⋮
                        </button>
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
        --table-header: #2e538f;
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

    .ticket-table thead {
        background-color: var(--table-header);
    }

    .ticket-table th {
        padding: 1.5rem 1rem;
        text-align: left;
        color: var(--font-color-medium-light);
        font-size: var(--text-label);
        letter-spacing: var(--table-letter-spacing);
        font-weight: 500;
        border-bottom: 1px solid var(--table-border);
    }

    .ticket-table td {
        padding: 1.2rem 1rem;
        color: var(--table-text);
        font-size: var(--text-table);
        letter-spacing: var(--table-letter-spacing);
        background-color: transparent;
        border-bottom: 1px solid var(--table-border);
    }

    .title-bold.muted {
        color: var(--table-text-muted);
    }

    .ticket-table td.updated {
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

    .pill.status {
        background-color: color-mix(
            in srgb,
            var(--bg-color-card) 84%,
            #6ccf8d
        );

        color: #4d7f5f;
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
        font-size: var(--text-page-title);
        cursor: pointer;
    }

    .actions-button:hover {
        background-color: var(--table-row-hover);
        color: var(--font-color-dark);
    }
</style>