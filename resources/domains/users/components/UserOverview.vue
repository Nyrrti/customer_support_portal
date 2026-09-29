<script setup lang="ts">
    import type { User } from '../types';
   
    const props = defineProps<{
        users: User[];
    }>();

</script>

<template>

    <div class="user-section">
        <table class="user-table">
            <colgroup>
                <col>
                <col>
                <col class="table-w-12">
                <col class="table-w-15">
            </colgroup>
            <thead>
                <tr class="user-table-header">
                    <th class="p-3 py-4">
                        <h4 class="table-title">
                            Users
                        </h4>
                    </th>
                    <th class="text-end p-3" colspan="3">
                        <RouterLink :to="{name: 'create-user'}" class="btn user">
                            + New user
                        </RouterLink>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-if="users.length">
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="border-bottom"
                    >
                        <td class="user-card" colspan="2">
                            {{ user.name }}
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
                </template>
                <tr v-else>
                    <td colspan="4">
                        No users yet.
                    </td>
                </tr>
            </tbody>

        </table>
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