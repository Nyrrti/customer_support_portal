<script setup lang="ts">
    import type { Category } from '../types';

    const props = defineProps<{
        categories: Category[];
    }>();

</script>

<template>

    <div class="category-section">
        <table class="category-table">
            <colgroup>
                <col>
                <col>
                <col class="table-w-12">
                <col class="table-w-15">
            </colgroup>
            <thead>
                <tr class="category-table-header">
                    <th class="p-3 py-4">
                            <h4 class="light">
                            Categories
                        </h4>
                    </th>
                    <th class="text-end p-3" colspan="3">
                        <RouterLink :to="{name: 'create-category'}" class="btn category">
                            + New Category
                        </RouterLink>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id" class="border-bottom">
                    <td class="category-card" colspan="2">
                        {{ category.title }}
                    </td>
                    <td class="text-end">
                        <button class="btn edit">
                            Edit
                        </button>
                    </td>
                    <td class="text-end">
                        <button class="btn delete">
                            Delete
                        </button>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>

</template>

<style scoped>

    .category-section {
        min-height: 100%;
        background-color: var(--bg-color-blue);
        border: 1px solid var(--border-color-blue);
        display: flex;
        flex-direction: column;
    }

    .category-table {
        background-color: var(--bg-color-card);
    }

    .category-table-header {
        background-color: var(--bg-color-blue);
    }

    .category-card {
        padding: 0.75rem 1.25rem;
    }

    .border-bottom {
        border-bottom: 1px solid var(--border-color-darker);
    }

    .btn.category {
        background-color: var(--color-yellow);
        color: var(--font-color-dark);
        padding: 0.8rem 2rem;
    }

    .btn.delete, .btn.edit {
        font-size: var(--text-label);
    }

</style>