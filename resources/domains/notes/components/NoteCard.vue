<script setup lang="ts">
    import type { Note } from '../types';
    import CheckTime from '../../../js/components/CheckTime.vue';

    defineProps<{
        notes: Note[];
    }>();

</script>


<template>

    <article
        v-for="note in notes"
        :key="note.id"
        class="note-card"
        >
            <p>
                {{ note.content }}
            </p>

        <small>
            {{ note.user?.name }} · <CheckTime :date="note.created_at" />
        </small>
    </article>

</template>

<style scoped>

    .note-card {
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 0.6rem;
        background: var(--bg-color-card);
        color: var(--font-color-medium-dark);
        overflow-wrap: anywhere;
    }

    .note-card:last-child {
        margin-bottom: 0;
    }

    .note-card p {
        margin: 0 0 0.3rem;
    }

    .note-card small {
        color: var(--font-color-medium-dark);
    }

</style>