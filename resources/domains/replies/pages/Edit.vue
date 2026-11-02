<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { replyStore } from "../store.js";
    import { useRouter, useRoute } from "vue-router";
    import type { Reply, UpdateReply } from "../types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";
   

    const route = useRoute();
    const router = useRouter();
   
    const { errors, saving, submit, clearError } = useForm();
    const loading = ref(true);
    const loadFailed = ref(false);

    const replyId = Number(route.params.id);

    const reply = computed<Reply | undefined>(() =>
        replyStore.getters.getById(replyId).value
    );

    /**
     * Updates the reply and returns to the ticket when succesfull.
     *
     * @param data - The updated values submitted by the child form.
     */
    const updateReply = async (data: UpdateReply) => {
        const saved = await submit(
            () => replyStore.actions.update(replyId, data)
        );

        if (saved) {
            await router.push({ name: "ticket-detail", params: { id: reply.value!.ticket_id } });
        }
    };

    onMounted(async () => {
        try {
            await replyStore.actions.getOne(replyId);
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });

</script>

<template>
    <LoggedInLayout>
        <div class="reply-page-background">
            <div class="form-wrapper py-3">
                <section
                    v-if="loading || loadFailed || !reply"
                    class="reply-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading reply</h2>
                        <p>Please wait while we load the details.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load reply</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>Reply not found</h2>
                        <p>This reply may have been deleted.</p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'tickets-overview' }"
                        class="reply-state-link"
                    >
                        Back to tickets
                    </RouterLink>
                </section>

                <Form 
                    v-else-if="reply"
                    mode="edit"
                    :reply="reply" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="updateReply"
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
        align-items: center;
        gap: 1rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.6rem;
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
    }

    .reply-state h2 {
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .reply-state p {
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .reply-state-link {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem 1.25rem;
        border-radius: 0.6rem;
    }

    .reply-state-link:focus-visible {
        outline: 2px solid var(--color-yellow);
        outline-offset: 3px;
    }
</style>