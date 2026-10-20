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
    <section class="notes-section">
        <button
        type="button"
        class="notes-header"
        :aria-expanded="isOpen"
        @click="isOpen = !isOpen"
        >
        <div class="notes-heading">
            <span class="lock-icon">
                <svg 
                    class="lock-icon"
                    width="28px" 
                    height="28px" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    xmlns="http://www.w3.org/2000/svg">
                <path d="M8.18164 10.7027C8.18164 10.7027 8.18168 8.13513 8.18164 6.59459C8.1816 4.74571 9.70861 3 11.9998 3C14.291 3 15.8179 4.74571 15.8179 6.59459C15.8179 8.13513 15.8179 10.7027 15.8179 10.7027" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.50005 11.3932C4.50001 13.1319 4.49995 16.764 4.50007 19.1988C4.5002 21.8911 8.66375 22.5 12.0001 22.5C15.3364 22.5 19.5 21.8911 19.5 19.1988L19.5 11.3932C19.5 10.8409 19.0523 10.3957 18.5 10.3957H5.50004C4.94777 10.3957 4.50006 10.8409 4.50005 11.3932ZM10.5 16.0028C10.5 16.4788 10.7069 16.9065 11.0357 17.2008V18.7529C11.0357 19.3051 11.4834 19.7529 12.0357 19.7529H12.1786C12.7309 19.7529 13.1786 19.3051 13.1786 18.7529V17.2008C13.5074 16.9065 13.7143 16.4788 13.7143 16.0028C13.7143 15.1152 12.9948 14.3957 12.1072 14.3957C11.2195 14.3957 10.5 15.1152 10.5 16.0028Z" fill="currentColor"/>
                </svg>
            </span>

            <div>
                <h4>Internal notes ({{ count }})</h4>
                <span class="notes-subtitle">
                    Administrators only
                </span>
            </div>
        </div>

        <span
            class="chevron"
            :class="{ rotated: isOpen }"
            aria-hidden="true"
        >
            ▼
        </span>
        </button>

        <div v-if="isOpen" class="notes-content">
        <slot />
        </div>
    </section>
</template>

<style scoped>
    .notes-section {
        --bg-ticket-card: #2d5690;

        overflow: hidden;
        border: 1px solid var(--card-border);
        border-radius: 0.6rem;
        background: var(--bg-color-card-dark);
        color: var(--bg-color-blue);
    }

    .notes-header {
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

    .notes-heading {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        min-width: 0;
    }

    .notes-heading h4 {
        color: var(--font-color-light);
    }

    .notes-subtitle {
        display: block;
        margin-top: 0.1rem;
        font-size: var(--text-label);
        color: var(--font-color-medium-light);
    }

    .chevron {
        font-size: var(--text-label);
        transition: transform 0.2s ease;
    }

    .chevron.rotated {
        transform: rotate(180deg);
    }

    .notes-content {
        padding: 1rem;
    }

    .notes-header:focus-visible {
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