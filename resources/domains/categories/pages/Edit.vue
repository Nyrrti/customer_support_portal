<script setup lang="ts">
    import { ref, onMounted, computed } from 'vue';
    import Form from '../components/Form.vue';
    import { categoryStore } from '../store.js';
    import { useRouter, useRoute } from 'vue-router';
    import type { Category } from '../types.js';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';

    const route = useRoute();
    const router = useRouter();
   
    const categoryId = Number(route.params.id);

    const category = computed<Category | undefined>(() =>
        categoryStore.getters.getById(categoryId).value
    );

    const updateCategory = async (data: Category) => {
        await categoryStore.actions.update(categoryId, data);
        router.push({ name: 'category-overview' });
    };

    onMounted(async () => {
        await Promise.all([
            categoryStore.actions.getAll(),
        ]);
        console.log(category.value);
    });

</script>

<template>
    <LoggedInLayout>
        <div class="category-page-background">
            <div class="form-wrapper py-3">
                <Form v-if="category" 
                    :category="category" 
                    mode="edit"
                    @submit="updateCategory" 
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