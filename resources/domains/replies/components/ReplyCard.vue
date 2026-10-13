<script setup lang="ts">
    import type { Reply } from "../types.js";
    import CheckTime from "../../../js/components/CheckTime.vue";
    import ActionButtons from "../../../js/components/ActionButtons.vue";

    defineProps<{
        reply: Reply;
        errors: Record<string, string[]>;
        deleting: boolean;
    }>();
    

</script>


<template>

    <div class="reply-card">
        <div class="reply-header">
            <div class="header-text">
                 <p class="reply-time">
                <CheckTime :date="reply.created_at" />
                </p>
                <p class="reply-time">|</p>
                <p class="reply-time">
                    Reply id: {{ reply.id }}
                </p>
                <h5>
                    {{ reply.user.name }}
                </h5>
            </div>
           
             <div class="actions yellow">
                Actions
             </div>
        </div>
        <div 
            class="reply-content"
        >
        <p>
             {{ reply.content }}
        </p>
        </div>
    </div>

</template>

<style scoped>

    .reply-card {
        --bg-ticket-card: #2d5690;
        --reply-card-border: #4d86d7;

        display: flex;
        flex-direction: column;
        justify-content: center;
        border: 1px solid var(--reply-card-border);
        border-radius: 0.6rem;
        background-color: var(--bg-color-card-dark);
        overflow: hidden;
    }

    .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1.25rem;
        background-color: var(--bg-ticket-card);
    }

    .header-text {
        display: flex;
        gap: 0.7rem;
    }

    .reply-content {
        padding: 1.25rem;
    }

    .reply-time {
        font-size: var(--text-label);
        color: var(--font-color-medium-light);
    }

    
</style>