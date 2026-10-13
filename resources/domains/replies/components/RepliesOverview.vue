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
    <div v-if="replies.length">
        <ReplyCard
            v-for="reply in replies"
            :key="reply.id"
            :reply="reply"
            :errors="errors"
            :deleting="deleting"
        />
    </div>

    <p v-else>No replies for this ticket yet.</p>
</template>