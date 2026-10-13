<script setup lang="ts">
    import type { Reply } from "../types.js";

    defineProps<{
        reply: Reply;
        errors: Record<string, string[]>;
        deleting: boolean;
    }>();
    

</script>


<template>

    <div class="reply-section">
        <div class="reply-header">
             <h4 class="yellow">
                Replies
            </h4>
        </div>
        <div 
            class="reply-content"
        >
            {{ reply.content }}
            Test
        </div>
    </div>

</template>

<style scoped>

    .reply-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        border: 1px solid var(--card-border);
        border-radius: 0.6rem 0.6rem 0 0;
    }

    .reply-header {
        display: flex;
        flex: 1;
        align-items: center;
        background-color: var(--bg-color-blue);
        padding: 1rem;
        border-radius: 0.6rem 0.6rem 0 0;
    }

    .reply-content {
        background-color: var(--bg-color-card);
        padding: 1rem;
    }

</style>