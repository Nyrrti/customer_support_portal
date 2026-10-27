<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { useRouter } from "vue-router";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";
    import type { CreateReply } from "../types.js";
    import { replyStore } from "../store.js";


    const router = useRouter();
    
    const { errors, saving, submit, clearError } = useForm();
   
    /**
     * Creates a reply
     *
     * @param data - The reply values submitted by the child form.
     */
    const createReply = async (data: CreateReply) => {
        const saved = await submit(
            () => replyStore.actions.create(data)
        );

        if (saved) {
            await router.push({ name: "tickets-overview" });
        }
    };
</script>

<template>
    <LoggedInLayout>
        <div class="reply-page-background">
            <div class="form-wrapper py-3">
                <Form
                    mode="create" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="createReply"
                    @dismiss-error="clearError" 
                />
            </div>
        </div>
    </LoggedInLayout>


</template>

<style scoped>

    .reply-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }

    .reply-state {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
    }

    .reply-state h2 {
        margin: 0;
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .reply-state p {
        margin: 0;
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .reply-state a {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem;
        border-radius: 0.6rem;
    }
</style>