<script setup lang="ts">
    import type { Reply } from "../types.js";
    import CheckTime from "../../../js/components/CheckTime.vue";
    import ActionButtons from "../../../js/components/ActionButtons.vue";

    defineProps<{
        replies: Reply[];
        errors: Record<string, string[]>;
        deleting: boolean;
        canManage: boolean;
    }>();
        
    const emit = defineEmits<{
        (event: "delete", reply: Reply): void;
    }>();
</script>


<template>

    <article
        v-for="reply in replies"
        :key="reply.id"
        class="reply-card"
        >
        <div class="title-header">
            <h5>
                {{ reply.title }} 
            </h5>
            <ActionButtons v-if="canManage"
                :edit-to="{ name: 'edit-reply', params: { id: reply.id }, query: { returnTo: $route.fullPath } }"
                label="reply"
                align="end"
                :deleting="deleting"
                @delete="emit('delete', reply)"
            />
        </div>
         
           
            <p>
                {{ reply.content }}
            </p>

        <small>
            {{ reply.user?.name }} · <CheckTime :date="reply.created_at" />
            <span v-if="reply.updated_at !== reply.created_at">
                · edited <CheckTime :date="reply.updated_at" />
            </span>
        </small>
    </article>

</template>

<style scoped>

    .reply-card {
        padding: 1.25rem;
        margin-bottom: 0.5rem;
        border-radius: 0.6rem;
        background: var(--bg-color-card);
        color: var(--font-color-medium-dark);
        overflow-wrap: anywhere;
    }

    .title-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .reply-card:last-child {
        margin-bottom: 0;
    }

    .reply-card p {
        margin: 0.3rem 0;
    }

    .reply-card small {
        color: var(--font-color-medium-dark);
    }

    
</style>