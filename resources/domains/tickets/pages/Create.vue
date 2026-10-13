<script setup lang="ts">
    import { onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { ticketStore } from "../store.js";
    import { categoryStore } from "../../categories/store.js"
    import { useRouter } from "vue-router";
    import type { CreateTicket } from "../types.js";
    import type { Category } from "../../categories/types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";

    const router = useRouter();
    
    const { errors, saving, submit } = useForm();
    
    /**
     * Creates a ticket and opens the overview after a successful save.
     *
     * @param data - The ticket values submitted by the child form.
     */
    const createTicket = async (data: CreateTicket) => {
        const saved = await submit(
            () => ticketStore.actions.create(data)
        );

        if (saved) {
            await router.push({ name: "tickets-overview" });
        }
    };

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch categories and put them into state
        await categoryStore.actions.getAll();
    });
</script>

<template>
    <LoggedInLayout>
        <div class="ticket-page-background">
            <div class="form-wrapper py-3">
                <Form 
                    mode="create"
                    :categories="categories" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="createTicket" 
                />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .ticket-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }
</style>