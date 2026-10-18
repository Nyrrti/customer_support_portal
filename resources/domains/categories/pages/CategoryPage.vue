<script setup lang="ts">
    import { computed, onMounted, ref } from "vue";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import CategoryOverview from "../components/CategoryOverview.vue";
    import { categoryStore } from "../store.js";
    import type { Category } from "../types.js";
    import { useForm } from "../../../js/composables/useForm.js";

    // saving: deleting means, take saving from the returned object, but call it deleting on this page.
    const { errors, saving: deleting, submit, clearError } = useForm();

    const loading = ref(true);
    const loadFailed = ref(false);

    /**
     * Asks for confirmation and deletes the selected category.
     *
     * Validation errors are handled by submit().
     * General request messages are handled by the Axios interceptor.
     *
     * @param category - The category selected for deletion.
     */
    async function deleteCategory(category: Category): Promise<void> {
        if (deleting.value) return;

        const confirmed = window.confirm(
            `Delete "${category.title}"? This cannot be undone.`
        );

        if (!confirmed) return;

        await submit(() => categoryStore.actions.delete(category.id));
    }

    /**
     * Reads the stored categories in alphabetical order.
     */
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
            .sort((a, b) => a.title.localeCompare(b.title))
    );

    /**
     * Loads the category overview.
     * The Axios interceptor displays general request errors.
     */
    onMounted(async () => {
        try {
            await categoryStore.actions.getAll();
        } catch {
            loadFailed.value = true;
        } finally {
            loading.value = false;
        }
    });
</script>

<template>

    <LoggedInLayout>
        <div class="category-page-background">
            <CategoryOverview
                :loading="loading"
                :load-failed="loadFailed"
                :categories="categories"
                :deleting="deleting"
                :errors="errors"
                @delete="deleteCategory"
                @dismiss-error="clearError('category')"
            />
        </div> 
    </LoggedInLayout>

</template>

<style scoped>

    .category-page-background {
        min-height: 100%;
        background-color: var(--bg-color-dark-blue);
        padding: 1rem;
    }

     @media (min-width: 1200px) {

        .category-page-background {
            padding: 1.5rem;
        }
    }

    .category-error {
        color: var(--font-color-light);
        background-color: #b9423f;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border: 1px solid #ea574d;
        border-radius: 0.25rem;
    }

</style>