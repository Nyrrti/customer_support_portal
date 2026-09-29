<script setup lang="ts">
    import type { User } from "../types"


    defineProps<{
        users: User[];
    }>();

</script>

<template>

    <div class ="overview-table-wrap">
        <table class="user-table">
            <colgroup>
                <col>
                <col>
                <col>
                <col class="table-w-10">
                <col>
                <col class="table-w-10">
            </colgroup>

            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col" aria-label="Actions"></th>
                </tr>
            </thead>
            <tbody>
                <template v-if="users.length">
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="border-bottom"
                    >
                    <td>
                        {{ user.first_name }}
                    </td>  
                    <td>
                        {{ user.last_name }}
                    </td>  
                    <td>
                        {{ user.email }}
                    </td> 
                    <td>
                        Role
                    </td>
                    <td>
                        {{ user.phone_number }}
                    </td>  
                    <td>
                        ...
                    </td> 
                </tr>
                </template>
                <tr v-else>
                    <td colspan="6">
                        No users yet.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<style scoped>

    .overview-table-wrap {
        --border-ticket-table: #426db2;
        --border-id: #bdc4cf;

        overflow-x: auto;
        border-radius: 0.6rem;
        border: 1px solid var(--border-ticket-table);
        min-height: 100%;
    }

    .user-table {
        background-color: var(--table-header);
    }

    .user-table thead {
        background-color: var(--table-header);
    }

    .user-table th {
        padding: 1.5rem 1rem;
        text-align: left;
        color: var(--font-color-medium-light);
        font-size: var(--text-label);
        letter-spacing: var(--table-letter-spacing);
        font-weight: 500;
        border-bottom: 1px solid var(--table-border);
    }

    .user-table td {
        padding: 1.2rem 1rem;
        color: var(--table-text);
        font-size: var(--text-table);
        letter-spacing: var(--table-letter-spacing);
        background-color: transparent;
        border-bottom: 1px solid var(--table-border);
    }

    .user-table td.updated {
        color: var(--font-color-medium-dark);
        font-size: var(--text-caption);
    }

    .user-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .user-table tbody tr:nth-child(odd) {
        background-color: var(--table-bg);
    }

    .user-table tbody tr:nth-child(even) {
        background-color: color-mix(
            in srgb,
            var(--table-bg) 98%,
            var(--color-grey)
        );
    }


</style>