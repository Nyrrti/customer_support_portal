<script setup lang="ts">
    import type { Reply } from "../types.js";
    import CheckTime from "../../../js/components/CheckTime.vue";
    import ActionButtons from "../../../js/components/ActionButtons.vue";

    defineProps<{
        replies: Reply[];
        errors: Record<string, string[]>;
        deleting: boolean;
    }>();
    

</script>


<template>

    <article
        v-for="reply in replies"
        :key="reply.id"
        class="reply-card"
        >
            <p>
                {{ reply.content }}
            </p>

        <small>
            {{ reply.user?.name }} · <CheckTime :date="reply.created_at" />
        </small>
    </article>

</template>

<style scoped>

    .reply-card {
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 0.6rem;
        background: var(--bg-color-card);
        color: var(--font-color-medium-dark);
        overflow-wrap: anywhere;
    }

    .reply-card:last-child {
        margin-bottom: 0;
    }

    .reply-card p {
        margin: 0 0 0.3rem;
    }

    .reply-card small {
        color: var(--font-color-medium-dark);
    }

    
</style>