<script setup lang="ts">
    import { useRouter } from "vue-router";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../../categories/store.js"
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import type { CreateCategory } from "../../categories/types.js";
    import { useForm } from "../../../js/composables/useForm.js";

    const router = useRouter();
    const { errors, saving, submit, clearError } = useForm();
    
    /**
     * Creates a category and opens the overview after a successful save.
     *
     * @param data - The category values submitted by the child form.
     */
    const createCategory = async (data: CreateCategory) => {
        const saved = await submit(
            () => categoryStore.actions.create(data)
        );

        if (saved) {
            await router.push({ name: "category-overview" });
        }
    };
</script>

<template>
    <LoggedInLayout>
        <div class="category-page-background">
            <div class="form-wrapper py-3">
                <Form 
                    mode="create"
                    :errors="errors" 
                    :saving="saving"
                    @submit="createCategory"
                    @dismiss-error="clearError"
                />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .category-page-background {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-dark-blue);
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }
</style>