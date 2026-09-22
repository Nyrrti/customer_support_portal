<script setup lang="ts">
    import { computed, onMounted } from "vue";
    import LoggedInLayout from "../../../js/layouts/LoggedInLayout.vue";
    import CategoryOverview from "../components/CategoryOverview.vue";
    import { categoryStore } from "../store.js";
    import type { Category } from "../types.js";

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch tickets and put them into state
        await categoryStore.actions.getAll();
    }); 
</script>

<template>

    <LoggedInLayout>
        <div class="category-page-background">
            <CategoryOverview :categories="categories" />
        </div> 
    </LoggedInLayout>

</template>

<style scoped>

    .category-page-background {
        min-height: 100%;
        background-color: var(--bg-color-dark-blue);
        padding: 1rem;
    }

</style>