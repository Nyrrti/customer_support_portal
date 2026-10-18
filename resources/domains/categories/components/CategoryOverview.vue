<script setup lang="ts">
    import type { Category } from "../types";
    import ActionButtons from "../../../js/components/ActionButtons.vue";
    import FieldError from "../../../js/components/FieldError.vue";
   
    const props = defineProps<{
        loading: boolean;
        loadFailed: boolean;
        categories: Category[];
        errors: Record<string, string[]>;
        deleting: boolean;
    }>();

    const emit = defineEmits<{
        delete: [category: Category];
        /** Requests that the parent clears the category error. */
        "dismiss-error": [];
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
        <p v-if="loading" class="category-status" role="status">
            Loading categories…
        </p>

        <p v-else-if="loadFailed" class="category-status">
            Could not load categories. Please refresh to try again.
        </p>

        <p v-else-if="categories.length === 0" class="category-status">
            No categories yet. Use “New Category” to create the first one.
        </p>
        <table v-else class="category-table">
            <colgroup>
                <col>
                <col class="table-w-30">
            </colgroup>
           
            <tbody>
                <tr v-if="errors.category?.length">
                    <td colspan="2" class="table-error">
                        <FieldError 
                            :errors="errors.category" 
                            @dismiss="emit('dismiss-error')"
                        />
                    </td>
                </tr>
                <tr v-for="category in categories" :key="category.id" class="border-bottom">
                    <td class="category-card">
                        {{ category.title }}
                    </td>
                    <td>
                        <ActionButtons
                            :edit-to="{ 
                                name: 'edit-category', 
                                params: { id: category.id }, 
                            }"
                            :label="category.title"
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

    .category-status {
        margin: 0;
        padding: 2rem 1.25rem;
        text-align: center;
        line-height: 1.6;
        color: var(--font-color-medium-dark);
        background-color: var(--bg-color-card);
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