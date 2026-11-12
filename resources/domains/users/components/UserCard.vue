<script setup lang="ts">
    import type { User } from "../types";
    import ActionButtons from "../../../js/components/ActionButtons.vue";

    defineProps<{
        users: User[];
        deleting: boolean;
    }>();

    const emit = defineEmits<{
        (event: "delete", user: User): void;
    }>();

    /**
     * Builds the avatar letters from first and last name, e.g. "Jane Doe" → "JD".
     */
    function initials(user: User): string {
        return `${user.first_name.charAt(0)}${user.last_name.charAt(0)}`.toUpperCase();
    }
</script>

<template>
    <ul v-if="users.length" class="user-card-list">
        <li v-for="user in users" :key="user.id" class="user-card">
            <div class="card-top">
                <span class="avatar" :class="{ admin: user.is_admin }" aria-hidden="true">
                    {{ initials(user) }}
                </span>

                <div class="identity">
                    <strong class="user-name">{{ user.name }}</strong>
                    <span class="role-pill" :class="{ admin: user.is_admin }">
                        {{ user.is_admin ? "Administrator" : "User" }}
                    </span>
                </div>

                <ActionButtons
                    :edit-to="{ name: 'edit-user', params: { id: user.id } }"
                    :label="`user ${user.name}`"
                    align="end"
                    :deleting="deleting"
                    @delete="emit('delete', user)"
                />
            </div>

            <dl class="contact">
                <div class="contact-row">
                    <dt>
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path d="m3 7 9 6 9-6" />
                        </svg>
                        <span class="visually-hidden">Email</span>
                    </dt>
                    <dd>
                        <a :href="`mailto:${user.email}`">{{ user.email }}</a>
                    </dd>
                </div>

                <div class="contact-row">
                    <dt>
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2" />
                        </svg>
                        <span class="visually-hidden">Phone number</span>
                    </dt>
                    <dd>
                        <a v-if="user.phone_number" :href="`tel:${user.phone_number}`">
                            {{ user.phone_number }}
                        </a>
                        <span v-else class="empty">No phone number</span>
                    </dd>
                </div>
            </dl>
        </li>
    </ul>

    <p v-else class="no-users">
        No users yet.
    </p>
</template>

<style scoped>

    .user-card-list {
        --card-border: #3b68a5;
        --card-border-dashed: #597db1;
        --bg-user-card: #2d5690;

        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .user-card {
        min-width: 0;
        border: 1px solid var(--card-border);
        border-radius: 1rem;
        background-color: var(--bg-user-card);
        overflow: hidden;
    }

    .card-top {
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) auto;
        align-items: center;
        gap: 0.85rem;
        padding: 1rem 1rem 0.9rem;
    }

    .avatar {
        width: 2.6rem;
        height: 2.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        font-size: var(--text-caption);
        font-weight: 700;
    }

    .avatar.admin {
        background-color: var(--color-purple);
    }

    .identity {
        min-width: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.3rem;
    }

    .user-name {
        max-width: 100%;
        color: var(--font-color-light);
        font-size: var(--text-label);
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .role-pill {
        padding: 0.1rem 0.55rem;
        border: 1px solid var(--font-color-medium-light);
        border-radius: 1rem;
        color: var(--font-color-medium-light);
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.03em;
    }

    .role-pill.admin {
        border-color: var(--color-yellow);
        color: var(--color-yellow);
    }

    /* Bottom block: contact details */
    .contact {
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 0.8rem 1rem;
        border-top: 1px dashed var(--card-border-dashed);
        background: var(--bg-color-card-medium);
    }

    .contact-row {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        min-width: 0;
    }

    .contact dt {
        display: flex;
        flex-shrink: 0;
    }

    .contact dd {
        margin: 0;
        min-width: 0;
        font-size: var(--text-label);
        overflow-wrap: anywhere;
    }

    .contact svg {
        width: 1.15rem;
        height: 1.15rem;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        color: var(--color-grey);
    }

    .contact a {
        color: var(--font-color-medium-dark);
        text-decoration: none;
    }

    .contact a:hover {
        text-decoration: underline;
    }

    .empty {
        color: var(--font-color-medium-dark);
        font-style: italic;
        opacity: 0.7;
    }

    .no-users {
        padding: 1.5rem;
        color: var(--font-color-medium-light);
        text-align: center;
    }

    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0 0 0 0);
        white-space: nowrap;
    }

    
    @media (min-width: 560px) {
        .contact {
            flex-direction: row;
            gap: 1.5rem;
        }

        .contact-row:first-child {
            flex: 1;
        }
    }
</style>