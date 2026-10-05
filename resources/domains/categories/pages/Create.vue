<script setup lang="ts">
    import { onMounted, computed, ref } from "vue";
    import { isAxiosError } from "axios";
    import { useRouter } from "vue-router";
    import Form from "../components/Form.vue";
    import { categoryStore } from "../../categories/store.js"
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import type { Category, CreateCategory } from "../../categories/types.js";

    const router = useRouter();
    const errors = ref<Record<string, string[]>>({});
    const message = ref("");

   const createCategory = async (data: CreateCategory) => {
        errors.value = {};
        message.value = "";

        try {
            await categoryStore.actions.create(data);
            await router.push({ name: "category-overview" });
        } catch (error) {
            if (isAxiosError(error) && error.response?.status === 422) {
                errors.value = error.response.data.errors ?? {};
            } else {
                message.value = "Could not create the category. Please try again.";
            }
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