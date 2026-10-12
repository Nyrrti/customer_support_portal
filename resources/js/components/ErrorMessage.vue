<script setup lang="ts">
    import { getMessage, destroyMessage } from "../services/error";
</script>

<template>
    <div v-if="getMessage" class="error-message" role="alert">
        <p>{{ getMessage }}</p>

        <button
            type="button"
            aria-label="Dismiss error message"
            @click="destroyMessage"
        >
            ×
        </button>
    </div>
</template>

<style scoped>
    .error-message {
        --error-bg-red: #ffd3d3;
        --error-text: #d5150a;

        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        margin-bottom: 1rem;
        color: var(--error-text);
        background-color: var(--error-bg-red);
        border-radius: 0.4rem;
    }

    .error-message p {
        margin: 0;
        color: var(--error-text);
    }

    .error-message button {
        border: 0;
        background: transparent;
        color: inherit;
        cursor: pointer;
        font-size: 1.25rem;
    }
</style>