<script setup lang="ts">
    import { ref, watch } from "vue";
    import CheckTime from "../../../js/components/CheckTime.vue";
    import FieldError from "../../../js/components/FieldError.vue";
    import { useForm } from "../../../js/composables/useForm";
    import { ticketStore } from "../store";
    import type { Ticket, TicketStatus } from "../types";

    /** The ticket loaded by the parent page. */
    const props = defineProps<{
        ticket: Ticket;
    }>();

    const { errors, saving, submit, clearError } = useForm();

    /** The selected status, kept separate until saving succeeds. */
    const selectedStatus = ref<TicketStatus>(props.ticket.status);

    /** Display labels for the API's status values. */
    const statusLabels: Record<TicketStatus, string> = {
        pending: "Pending",
        open: "Open",
        closed: "Closed"
    };

    /** Keeps the selection aligned with the saved ticket status. */
    watch(
        () => props.ticket.status,
        (status) => {
            selectedStatus.value = status;
        }
    );

    /**
     * Saves the selected status through the ticket store.
     *
     * @returns A promise that resolves after handling submission.
     */
    async function saveStatus(): Promise<void> {
        if (
            !props.ticket.can_change_status ||
            selectedStatus.value === props.ticket.status
        ) {
            return;
        }

        await submit(() =>
            ticketStore.actions.updateStatus(
                props.ticket.id,
                selectedStatus.value
            )
        );
    }
    
    /** Clears the validation messages for the status field. */
    function clearStatusError(): void {
        clearError("status");
    }
</script>

<template>
    <div class="ticketdetail-section">
        <div :key="ticket.id">
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
                </dl>
                <section class="ticket-status-section" aria-labelledby="ticket-status-heading">
                    <div class="ticket-status-heading-row">
                        <h4 id="ticket-status-heading">
                            <svg
                                class="status-heading-icon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="9" />
                                <circle cx="12" cy="12" r="3" fill="currentColor" stroke="none" />
                            </svg>
                            Status:
                        </h4>

                        <p
                            class="status-pill"
                            :class="`status-pill--${ticket.status}`"
                            aria-live="polite"
                        >
                            <svg
                                class="status-pill-icon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                                focusable="false"
                            >
                                <!-- Pending: clock -->
                                <template v-if="ticket.status === 'pending'">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 2" />
                                </template>

                                <!-- Open: three dots -->
                                <template v-else-if="ticket.status === 'open'">
                                    <circle cx="5" cy="12" r="1" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="19" cy="12" r="1" />
                                </template>

                                <!-- Closed: check -->
                                <template v-else-if="ticket.status === 'closed'">
                                    <path d="m5 12 4 4L19 6" />
                                </template>
                            </svg>

                            <span>{{ statusLabels[ticket.status] }}</span>
                        </p>
                    </div>
                    <form
                        v-if="ticket.can_change_status"
                        class="ticket-status-form"
                        @submit.prevent="saveStatus"
                    >
                        <div class="ticket-status-controls">
                            <label for="ticket-status">Change status</label>

                            <select
                                class="status-select"
                                id="ticket-status"
                                v-model="selectedStatus"
                                :disabled="saving"
                                @change="clearStatusError"
                            >
                                <option value="pending">Pending</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>

                            <button
                                class="btn status"
                                type="submit"
                                :disabled="saving || selectedStatus === ticket.status"
                            >
                                <span v-if="saving">Saving...</span>
                                <span v-else>Save status</span>
                            </button>
                        </div>

                        <FieldError
                            :errors="errors.status"
                            @dismiss="clearStatusError"
                        />
                    </form>  
                </section>
                <div class="ticket-summary-description">
                    <h4>Description</h4>
                    <p>{{ ticket.description }}</p>
                </div>  
            </section>
        </div>
    </div>
</template>

<style scoped>

    .ticketdetail-section {
        --card-border: #3b68a5;
        --ticket-card-border-dark: #597db1;
        --bg-ticket-card: #2d5690;

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
        padding: 1.75rem;
        background: var(--bg-color-card);
    }

    .ticket-summary-description p {
        margin-block: 0.3rem;
        line-height: 1.6;
    }

    .ticket-status-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1.25rem;
        align-items: center;
        border-top: 1px solid var(--border-color-outside);
        background-color: color-mix(
            in srgb,
            var(--bg-color-blue) 3%,
            transparent
        );
    }

    .ticket-status-heading-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .ticket-status-heading-row h4 {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--font-color-medium-dark);
    }

    .status-heading-icon {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

    .ticket-status-heading-row .status-pill {
        align-self: auto;
    }

    .ticket-status-form {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 0.3rem;
    }

    .ticket-status-controls {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .status-select {
        font-size: var(--text-label);
        color: var(--font-color-medium-dark);
        padding: 0.5rem 0.75rem;
    }

    .btn.status {
        padding: 0.5rem 0.75rem;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        gap: 0.4rem;
        padding: 0.35rem 0.75rem;
        border: 1px solid currentColor;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        line-height: 1.4;
    }

    .status-pill--pending {
        color: #854d0e;
        background-color: #fef3c7;
    }

    .status-pill--open {
        color: #29a12d;
        background-color: #dbfee8;
    }

    .status-pill--closed {
        color: var(--color-red);
        background-color: #fce1dc;
    }

    .status-pill-icon {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
    }

</style>