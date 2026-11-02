<script setup lang="ts">
    import type { Note } from '../types';
    import CheckTime from '../../../js/components/CheckTime.vue';
    import ActionButtons from '../../../js/components/ActionButtons.vue';

    defineProps<{
        notes: Note[];
        deleting: boolean;
    }>();

    const emit = defineEmits<{
        (event: "delete", note: Note): void;
    }>();
</script>


<template>

    <article
        v-for="note in notes"
        :key="note.id"
        class="note-card"
        >
        <div class="content-row">
            <p>
                {{ note.content }}
            </p>
            <small>
                {{ note.user?.name }} · <CheckTime :date="note.created_at" />
            </small>
        </div>
        <ActionButtons
                :edit-to="{ name: 'edit-note', params: { id: note.id }, query: { returnTo: $route.fullPath } }"
                label="note"
                align="end"
                :deleting="deleting"
                @delete="emit('delete', note)"
        /> 
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
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content-row {
        display: flex;
        flex-direction: column;
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