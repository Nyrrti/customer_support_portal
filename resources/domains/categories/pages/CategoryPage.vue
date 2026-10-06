<script setup lang="ts">
    import { computed, onMounted, ref } from "vue";
    import { isAxiosError } from "axios";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import CategoryOverview from "../components/CategoryOverview.vue";
    import { categoryStore } from "../store.js";
    import type { Category } from "../types.js";

    const error = ref("");
    const deleting = ref(false);

    async function deleteCategory(category: Category) {
        if (deleting.value) return;

        const confirmed = window.confirm(
            `Delete "${category.title}"? This cannot be undone.`
        );

        if (!confirmed) return;

        error.value = "";
        deleting.value = true;

        try {
            await categoryStore.actions.delete(category.id);
        } catch (failure) {
            error.value = "Could not delete the category. Please try again.";

            if (isAxiosError(failure)) {
                error.value =
                    failure.response?.data?.errors?.category?.[0]
                    ?? error.value;
            }
        } finally {
            deleting.value = false;
        }
    }

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
            .sort((a, b) => a.title.localeCompare(b.title))
    );

    onMounted(async () => {
        // Fetch tickets and put them into state
        await categoryStore.actions.getAll();
    }); 
</script>

<template>

    <LoggedInLayout>
        <div class="category-page-background">
            <p v-if="error" role="alert" class="category-error">
                {{ error }}
            </p>
            <CategoryOverview
                :categories="categories"
                :deleting="deleting"
                :error="error"
                @delete="deleteCategory"
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