<script setup lang="ts">
    import { ref, onMounted, computed } from "vue";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../store.js";
    import { useRouter, useRoute } from "vue-router";
    import type { Category, UpdateCategory } from "../types.js";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";

    const route = useRoute();
    const router = useRouter();
   
    const errors = ref<ValidationErrors>({});
    
    const clearError = (field: string) => {
        delete errors.value[field];
    };
    const categoryId = Number(route.params.id);

    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    const category = computed<Category | undefined>(() =>
        categoryStore.getters.getById(categoryId).value
    );

    const updateCategory = async (data: UpdateCategory) => {
        await categoryStore.actions.update(categoryId, data);
        await router.push({
            name: "category-overview"
        });
    };

    onMounted(async () => {
        await categoryStore.actions.getAll();
    });

</script>

<template>
    <LoggedInLayout>
        <div class="category-page-background">
            <div class="form-wrapper py-3">
                <Form 
                    mode="edit"
                    :categories="categories"
                    :category="category" 
                    :errors="errors" 
                    @submit="updateCategory" 
                    @clear-error="clearError"
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