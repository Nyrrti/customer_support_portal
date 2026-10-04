<script setup lang="ts">
    import type { Category } from '../types';

    const props = defineProps<{
        categories: Category[];
        deleting: boolean;
    }>();

    const emit = defineEmits<{
        (event: "delete", category: Category): void;
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
                        <h4 class="table-title">
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
                        <RouterLink :to="{ name: 'edit-category', params: { id: category.id } }" class="btn edit">
                            Edit
                        </RouterLink>
                    </td>
                    <td class="text-end">
                        <button
                            class="btn delete"
                            type="button"
                            :disabled="deleting"
                            @click="emit('delete', category)"
                        >
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
        border-radius: 0.6rem;
        overflow: hidden;
    }

    .category-table {
        background-color: var(--bg-color-card);  
    }

    .table-title {
        color: var(--font-color-medium-light);
    }

    .category-table-header {
        background-color: var(--table-header);
        border-radius: 0.6rem;
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

     @media (min-width: 1200px) {

        .category-card {
            padding: 1.5rem 2rem;
        }
    }

</style>