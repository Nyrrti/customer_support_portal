<script setup lang="ts">
    import { onMounted, computed } from "vue";
    import { useRouter } from "vue-router";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../../categories/store.js"
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
     import type { Category, CreateCategory } from "../../categories/types.js";

    const router = useRouter();
    
    const createCategory = async (data: CreateCategory) => {
        await categoryStore.actions.create(data);
        router.push({name: "category-overview"});
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
                <Form :categories="categories" @submit="createCategory" mode="create"/>
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