<script setup lang="ts">
    import { onMounted, ref, computed } from "vue";
    import { useRoute } from "vue-router";
    import { ticketStore } from "../store";
    import { noteStore } from "../../notes/store";
    import { replyStore } from "../../replies/store";
    import TicketDetails from "../components/TicketDetails.vue";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import CollapsibleNotes from "../../notes/components/CollapsibleNotes.vue";
    import NoteCard from "../../notes/components/NoteCard.vue";
    import CollapsibleReplies from "../../replies/components/CollapsibleReplies.vue";
    import ReplyCard from "../../replies/components/ReplyCard.vue";
    import { useForm } from "../../../js/composables/useForm";
    import type { Reply } from "../../replies/types";
    import type { Note } from "../../notes/types";

    const route = useRoute();
    // saving: deleting means, take saving from the returned object, but call it deleting on this page.
    const { errors, saving: deleting, submit, clearError } = useForm();

    const ticketId = computed(() => Number(route.params.id));

    const ticket = computed(() =>
        ticketStore.getters.getById(ticketId.value).value
    );

    /**
     * Notes belonging to the ticket currently on screen.
     */
    const notes = computed(() =>
        Object.values(noteStore.getters.all.value)
            .filter(note => note.ticket_id === ticketId.value)
    );
    
    /**
     * Replies belonging to the ticket currently on screen.
     */
    const replies = computed(() =>
        Object.values(replyStore.getters.all.value)
            .filter(reply => reply.ticket_id === ticketId.value)
    );

    const loading = ref(true);
    const loadFailed = ref(false);
    
    /**
     * Asks for confirmation and deletes the selected reply.
     *
     * Validation errors are handled by submit().
     * General request messages are handled by the Axios interceptor.
     *
     * @param reply - The reply selected for deletion.
     */
    async function deleteReply(reply: Reply): Promise<void> {
        if (deleting.value) return;

        const confirmed = window.confirm(
            `Delete "${reply.id}"? This cannot be undone.`
        );

        if (!confirmed) return;

        await submit(() => replyStore.actions.delete(reply.id));
    }

    /**
     * Loads the Ticket and Replies, Notes related to that ticket
     * The Axios interceptor displays general request errors.
     */
    onMounted(async () => {
        try {
            await ticketStore.actions.getOne(ticketId.value);
            await noteStore.actions.getByTicket(ticketId.value);
            await replyStore.actions.getByTicket(ticketId.value);
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });

</script>

<template>
    <LoggedInLayout>
        <div class="ticket-detail-background">
            <section v-if="loading" class="ticket-state" role="status">
                <h2>Loading ticket</h2>
                <p>Please wait while we load the details.</p>
            </section>

            <section v-else-if="loadFailed" class="ticket-state">
                <h2>Ticket unavailable</h2>
                <p>The ticket could not be loaded.</p>

                <RouterLink :to="{ name: 'tickets-overview' }">
                    Back to tickets
                </RouterLink>
            </section>

            <template v-else-if="ticket">
                <TicketDetails :ticket="ticket" />
                <CollapsibleNotes :count="notes.length">
                    <NoteCard :notes="notes" />
                </CollapsibleNotes>
                <CollapsibleReplies :count="replies.length">
                    <ReplyCard 
                        :replies="replies"
                        :errors="errors"
                        :deleting="deleting"
                    />
                </CollapsibleReplies>
            </template>
        </div>
        
    </LoggedInLayout>

</template>

<style scoped>

    .ticket-detail-background {
        display: flex;
        flex-direction: column;
        background-color: var(--bg-color-dark-blue);
        min-height: 100%;
        padding: 0.5rem;
        gap: 1rem;
    }

    .ticket-state {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
    }

    .ticket-state h2 {
        color: var(--font-color-dark);
    }

    .ticket-state p {
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .ticket-state a {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem;
        border-radius: 0.6rem;
    }

    @media (min-width: 1200px) {

        .ticket-detail-background {
            padding: 1.5rem;
            gap: 1.25rem;
        }
    }
</style>


