<script setup lang="ts">
    import { onMounted, computed, ref } from "vue";
    import { useRouter } from "vue-router";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../../categories/store.js"
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import type { Category, CreateCategory } from "../../categories/types.js";
    import { useForm } from "../../../js/composables/useForm.js";

    const router = useRouter();
    const { errors, saving, submit } = useForm();
    
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
        <div class="category-page-background">
            <div class="form-wrapper py-3">
                <Form 
                    mode="create"
                    :categories="categories"
                    :errors="errors" 
                    :saving="saving"
                    @submit="createCategory"
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