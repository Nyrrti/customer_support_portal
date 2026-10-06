<script setup lang="ts">
    import type { Category } from '../types';
    import ActionButtons from '../../../js/components/ActionButtons.vue';
   

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
        <div class="category-header">
            <h4 class="table-title">
                Categories
            </h4> 
            <RouterLink :to="{name: 'create-category'}" class="btn category">
                + New Category
            </RouterLink>
        </div>
        <table class="category-table">
            <colgroup>
                <col>
                <col class="table-w-30">
            </colgroup>
           
            <tbody>
                <tr v-for="category in categories" :key="category.id" class="border-bottom">
                    <td class="category-card">
                        {{ category.title }}
                    </td>
                    <td>
                        <ActionButtons
                            :edit-to="{ name: 'edit-category', params: { id: category.id } }"
                            label="category"
                            align="end"
                            :deleting="deleting"
                            @delete="emit('delete', category)"
                        />
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

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--table-header);
        padding: 1.25rem;
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

        .category-header {
            padding: 1.5rem;
        }
    }

</style>