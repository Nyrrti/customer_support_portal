<script setup lang="ts">
    import type { User } from '../types';
    import UserTable from "../components/UserTable.vue"
   
    const props = defineProps<{
        users: User[];
    }>();

</script>

<template>
    
    <div class="user-section">
        <UserTable :users="users" />
    </div>

</template>

<style scoped>

    .user-section {
        min-height: 100%;
        background-color: var(--bg-color-blue);
        border: 1px solid var(--border-color-blue);
        display: flex;
        flex-direction: column;
        border-radius: 0.6rem;
        overflow: hidden;
    }

    .user-table {
        background-color: var(--bg-color-card);  
    }

    .table-title {
        color: var(--font-color-medium-light);
    }

    .user-table-header {
        background-color: var(--table-header);
        border-radius: 0.6rem;
    }

    .user-card {
        padding: 0.75rem 1.25rem;
    }

    .border-bottom {
        border-bottom: 1px solid var(--border-color-darker);
    }

    .btn.user {
        background-color: var(--color-yellow);
        color: var(--font-color-dark);
        padding: 0.8rem 2rem;
    }

    .btn.delete, .btn.edit {
        font-size: var(--text-label);
    }

     @media (min-width: 1200px) {

        .user-card {
            padding: 1.5rem 2rem;
        }
    }

</style>