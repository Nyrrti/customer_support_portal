
<script setup lang="ts">
    import { computed } from 'vue';
    import type { TicketStatus } from '../../domains/tickets/types';

    const props = defineProps<{
        status: TicketStatus;
    }>();

    const statusLabels: Record<TicketStatus, string> = {
        pending: "Pending",
        open: "Open",
        closed: "Closed",
    };

    const statusLabel = computed(() => statusLabels[props.status]);
</script>

<template>
    <span
        class="status-pill"
        :class="`status-pill--${status}`"
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
        >
            <template v-if="status === 'pending'">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 7v5l3 2" />
            </template>

            <template v-else-if="status === 'open'">
                <circle cx="5" cy="12" r="1" />
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
            </template>

            <template v-else-if="status === 'closed'">
                <path d="m5 12 4 4L19 6" />
            </template>
        </svg>
        
        <span>{{ statusLabel }}</span>
    </span>
</template>

<style scoped>
    .status-pill {
        --color-open: #31906a;
        --color-closed: #b44f4f;
        --color-pending: #9b7c3a;

        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        gap: 0.3rem;
        padding: 0.3rem 0.7rem;
        border: 1px solid currentColor;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        line-height: 1.4;
        white-space: nowrap;
    }

    .status-pill--pending {
        color: var(--color-pending);
        background-color: #dcd5bb;
    }

    .status-pill--open {
        color: var(--color-open);
        background-color: #bbd4ca;
    }

    .status-pill--closed {
        color: var(--color-closed);
        background-color: #dec2be;
    }

    .status-pill-icon {
        display: block;
        width: 0.85rem;
        height: 0.85rem;
        flex-shrink: 0;
    }
</style>
