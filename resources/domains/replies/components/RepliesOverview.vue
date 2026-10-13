<script setup lang="ts">
    import { computed, onMounted, ref } from "vue";
    import { replyStore } from "../store.js";
    import ReplyCard from "../components/ReplyCard.vue"
    import { useForm } from "../../../js/composables/useForm.js";
    import type { Reply } from "../types.js";
    import { useRoute } from "vue-router";

    const route = useRoute();

    // saving: deleting means, take saving from the returned object, but call it deleting on this page.
    const { errors, saving: deleting, submit, clearError } = useForm();

    // Get the current ticket ID
    const ticketId = computed(() => Number(route.params.id));

    /**
     * Reads the stored Replies.
     */
    const replies = computed<Reply[]>(() =>
        Object.values(replyStore.getters.all.value)
    );

    onMounted(async () => {
        await replyStore.actions.getByTicket(ticketId.value);
    });

</script>

<template>
    <div class="reply-section">
        <div class="reply-header">
            <h4>
                Replies
            </h4>
        </div>
        <div v-if="replies.length" class="reply-cards">
            <ReplyCard
                v-for="reply in replies"
                :key="reply.id"
                :reply="reply"
                :errors="errors"
                :deleting="deleting"
            />
        </div>

    <p v-else>No replies for this ticket yet.</p>
    </div>
</template>

<style scoped>

    .reply-section {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        background-color: var(--bg-color-card);
        padding: 1rem;
        border: 1px solid var(--card-border);
        border-radius: 0.6rem;
    }

    .reply-cards {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    @media (min-width: 1200px) {

        .reply-cards {
            gap: 1rem;
        }
    }
</style>