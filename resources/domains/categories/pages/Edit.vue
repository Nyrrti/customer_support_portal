<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../store.js";
    import { useRouter, useRoute } from "vue-router";
    import type { Category, UpdateCategory } from "../types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import { useForm } from "../../../js/composables/useForm.js";
   

    const route = useRoute();
    const router = useRouter();
   
    const { errors, saving, submit, clearError } = useForm();
    const loading = ref(true);
    const loadFailed = ref(false);

    const categoryId = Number(route.params.id);

    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    const category = computed<Category | undefined>(() =>
        categoryStore.getters.getById(categoryId).value
    );

    /**
     * Updates the category and opens the overview after a successful save.
     *
     * @param data - The updated values submitted by the child form.
     */
    const updateCategory = async (data: UpdateCategory) => {
        const saved = await submit(
            () => categoryStore.actions.update(categoryId, data)
        );

        if (saved) {
            await router.push({ name: "category-overview" });
        }
    };

    /**
     * Loads categories before displaying the edit form.
     * General request errors are displayed by the Axios interceptor.
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
            <div class="form-wrapper py-3">
                <section
                    v-if="loading || loadFailed || !category"
                    class="category-state"
                    aria-live="polite"
                    :aria-busy="loading"
                >
                    <template v-if="loading">
                        <h2>Loading category</h2>
                        <p>Please wait while we load the details.</p>
                    </template>

                    <template v-else-if="loadFailed">
                        <h2>Could not load category</h2>
                        <p>Please refresh the page to try again.</p>
                    </template>

                    <template v-else>
                        <h2>Category not found</h2>
                        <p>This category may have been deleted.</p>
                    </template>

                    <RouterLink
                        v-if="!loading"
                        :to="{ name: 'category-overview' }"
                        class="category-state-link"
                    >
                        Back to categories
                    </RouterLink>
                </section>

                <Form 
                    v-else-if="category"
                    mode="edit"
                    :category="category" 
                    :errors="errors" 
                    :saving="saving"
                    @submit="updateCategory"
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

    .category-state {
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

    .category-state h2 {
        color: var(--font-color-dark);
        font-size: 1.25rem;
    }

    .category-state p {
        color: var(--font-color-medium-dark);
        line-height: 1.6;
    }

    .category-state-link {
        color: var(--color-yellow);
        background-color: var(--bg-color-blue);
        padding: 1rem 1.25rem;
        border-radius: 0.6rem;
    }

    .category-state-link:focus-visible {
        outline: 2px solid var(--color-yellow);
        outline-offset: 3px;
    }
</style>