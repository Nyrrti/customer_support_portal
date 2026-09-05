<script setup lang="ts">
    import { ref, onMounted, computed } from 'vue';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store.js';
    import { categoryStore } from "../../categories/store.js"
    import { useRouter } from 'vue-router';
    import type { CreateTicket } from '../types.js';
    import type { Category } from '../../categories/types.js';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';

    const router = useRouter();
    
    const createTicket = async (data: CreateTicket) => {
        await ticketStore.actions.create(data);
        router.push({name: 'dashboard'});
    };

    // Read the state
    const categories = computed<Category[]>(() =>
        Object.values(categoryStore.getters.all.value)
    );

    onMounted(async () => {
        // Fetch categories and put them into state
        await categoryStore.actions.getAll();

        console.log("store:", categoryStore.getters.all.value);
        console.log("array:", Object.values(categoryStore.getters.all.value));
    });

</script>

<template>
    <LoggedInLayout>
        <div class="dashboard-bg">
            <div class="form-wrapper py-3">
                <Form :categories="categories" @submit="createTicket" />
            </div>
        </div>
    </LoggedInLayout>
</template>

<style scoped>

    .dashboard-bg {
        min-height: 100%;
        padding: 1rem;
        background-color: var(--bg-color-secondary);
        background:
        linear-gradient(
            135deg,
            var(--bg-color-secondary),
            color-mix(in srgb, var(--bg-color-secondary) 95%, rgb(92, 119, 153))
        );
    }

    .form-wrapper {
        max-width: 34rem;
        margin: 0 auto;
    }
</style>