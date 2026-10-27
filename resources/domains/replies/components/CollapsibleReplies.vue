<script setup lang="ts">

    import { ref } from "vue";

    const props = defineProps({
        count: {
            type: Number,
            default: 0,
        },
        initiallyOpen: {
            type: Boolean,
            default: false,
        },
    });

    const isOpen = ref(props.initiallyOpen)
</script>

<template>
    <section class="replies-section">
        <button
        type="button"
        class="replies-header"
        :aria-expanded="isOpen"
        @click="isOpen = !isOpen"
        >
        <div class="replies-heading">
            <span class="lock-icon">
                <svg width="28px" height="28px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" id="Layer_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Layer_3">
                        <path d="M0,1.499v36h12.031V48l14.906-10.501H48v-36H0z M44,33.499H26.906L16,41.125v-3.75v-3.876H4v-28h40V33.499z   " fill="currentColor"/>
                    </g>
                </svg>
            </span>

            <div>
                <h4>Replies ({{ count }})</h4>
            </div>
        </div>
        <div class="replies-actions">
        <RouterLink
            :to="
            { 
                name: 'create-reply',
                query: { returnTo: $route.fullPath }
            }"
            class="btn reply"
        >
            + Reply
        </RouterLink>
        <span
            class="chevron"
            :class="{ rotated: isOpen }"
            aria-hidden="true"
        >
            ▼
        </span>
        </div>
        </button>
        
        <div v-if="isOpen" class="replies-content">
            <slot />
        </div>
    </section>
</template>

<style scoped>
    .replies-section {
        --bg-ticket-card: #2d5690;

        overflow: hidden;
        border: 1px solid var(--card-border);
        border-radius: 0.6rem;
        background: var(--bg-color-card-dark);
        color: var(--bg-color-blue);
    }

    .replies-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        width: 100%;
        padding: 1rem 1.25rem;
        border: 0;
        background: var(--bg-ticket-card);
        color: var(--font-color-light);
        text-align: left;
        cursor: pointer;
    }

    .replies-heading {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 0;
    }

    .replies-heading h4 {
        color: var(--font-color-light);
    }

    .replies-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .chevron {
        font-size: var(--text-label);
        transition: transform 0.2s ease;
    }

    .chevron.rotated {
        transform: rotate(180deg);
    }

    .btn.reply {
        border: 2px solid var(--color-yellow);
        border-radius: 1.5rem;
        background-color: transparent;
        padding: 0.5rem 0.75rem;
    }
    
    .btn.reply:hover {
        background-color: var(--color-yellow);
        color: var(--font-color-dark);
    }

    .replies-content {
        padding: 1rem;
    }

    .replies-header:focus-visible {
        outline: 3px solid var(--color-yellow);
        outline-offset: -3px;
    }

    .lock-icon {
        color: var(--color-yellow);
    }

    @media (prefers-reduced-motion: reduce) {
        .chevron {
            transition: none;
        }
    }
</style>