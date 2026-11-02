<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { noteStore } from "../store.js";
    import { useRouter, useRoute } from "vue-router";
    import type { Note, UpdateNote } from "../types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";
   

    const route = useRoute();
    const router = useRouter();
   
    const { errors, saving, submit, clearError } = useForm();
    const loading = ref(true);
    const loadFailed = ref(false);

    const noteId = Number(route.params.id);

    const note = computed<Note | undefined>(() =>
        noteStore.getters.getById(noteId).value
    );

    /**
     * Updates the note and returns to the ticket when succesfull.
     *
     * @param data - The updated values submitted by the child form.
     */
    const updateNote = async (data: UpdateNote) => {
        const saved = await submit(
            () => noteStore.actions.update(noteId, data)
        );

        if (saved) {
            await router.push({ name: "ticket-detail", params: { id: note.value!.ticket_id } });
        }
    };

    onMounted(async () => {
        try {
            await noteStore.actions.getOne(noteId);
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });

</script>

<template>
    <LoggedInLayout>
        <div class="note-page-background">
            <div class="form-wrapper py-3">
                <section
                    v-if="loading || loadFailed || !note"
                    class="note-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading note</h2>
                        <p>Please wait while we load the details.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load note</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>Note not found</h2>
                        <p>This note may have been deleted.</p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'tickets-overview' }"
                        class="note-state-link"
                    >
                        Back to tickets
                    </RouterLink>
                </section>

                <Form 
                    v-else-if="note"
                    mode="edit"
                    :note="note" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="updateNote"
                    @dismiss-error="clearError" 
                />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .note-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }

    .note-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
    }

    .note-state h2 {
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .note-state p {
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .note-state-link {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem 1.25rem;
        border-radius: 0.6rem;
    }

    .note-state-link:focus-visible {
        outline: 2px solid var(--color-yellow);
        outline-offset: 3px;
    }
</style>