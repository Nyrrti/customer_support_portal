<script setup lang="ts">
import { ref } from 'vue';
import type { User, CreateUser, UpdateUser } from '../types';


    const props = defineProps<{
        mode: "create" | "edit"
        user?: User;
    }>();
    
    const user = ref<CreateUser>({
        first_name: props.user?.first_name ?? "",
        last_name: props.user?.last_name ?? "",
        email: props.user?.email ?? "",
        phone_number: null as number | null,
    });

    /**
     * Defines the custom events this component can emit.
     * 
     * The "submit" event must include one Createuser object.
     */
    const emit = defineEmits<{
        submit: [user: CreateUser | UpdateUser]
    }>();

    /**
     * Handles submitting the user form.
     *
     * Emits the current Createuser data to the parent component,
     * where it can be sent to the store/API.
     *
     * @returns void
     */
    const submitForm = () => {
        emit("submit", user.value);
    };
</script>

<template>
    <div class="nav-link my-2 p-2">
        <RouterLink :to="{ name: 'user-overview' }">
            Users 
        </RouterLink>
        <span>
            > {{ mode === "create" ? "Create new user" : "Edit user" }}
        </span>
    </div>
    <form class="user-form-bg"  @submit.prevent="submitForm">
        <div class="user-form-heading p-4">
            <div class="d-flex items-center">
                <div class="user-form-icon me-1" aria-hidden="true">
                    <svg
                        viewBox="0 0 24 24"
                        width="40"
                        height="40"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1"
                    >
                        <path d="M4 7a2 2 0 0 1 2-2h12v4a2 2 0 0 0 0 4v4H6a2 2 0 0 1-2-2v-2a2 2 0 0 0 0-4V7Z" />
                        <path d="M9 8v8" stroke-dasharray="2 2" />
                    </svg>
                </div>
                <h5>
                    {{ mode === "create" ? "Create new user" : "Edit user" }}
                </h5>
            </div>
            <RouterLink
                :to="{ name: 'user-overview' }"
                class="user-form-icon form-close"
                aria-label="Back to user overview"
            >
                ↩
            </RouterLink>
        </div>
        <div class="user-form-input-field">
            <div class="field">
                <label for="firstName">
                    First Name
                </label>
                <input 
                    id="firstName"
                    v-model="user.first_name"
                    type="text"
                >
                <label for="firstName">
                    Last Name
                </label>
                <input 
                    id="lastName"
                    v-model="user.last_name"
                    type="text"
                >
                <label for="firstName">
                    Email
                </label>
                <input 
                    id="email"
                    v-model="user.email"
                    type="email"
                >
                <label for="firstName">
                    Phone Number
                </label>
                <input 
                    id="phoneNumber"
                    v-model="user.phone_number"
                    type="tel"
                >
            </div>
        </div>
        <div class="user-form-footer p-4">
            <button class="btn create" type="submit">
                {{ mode === "create" ? "Create user" : "Edit user" }}
            </button>
        </div>
    </form>
</template>

<style scoped>

    .nav-link span {
        color: var(--font-color-medium-light);
    }

    .user-form-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--bg-color-card-dark);
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .user-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 0.6rem 0.6rem 0 0;
        background: var(--bg-color-card-dark);
        background: linear-gradient(150deg, 
            rgb(136, 82, 206) 0%, 
            rgb(85, 122, 192) 40%, 
            rgb(85, 122, 192) 60%, 
            rgb(44, 136, 182) 100%
        );   
        position: relative;
    }

    .user-form-heading h5 {
        color: var(--font-color-light);
    }

    .user-form-icon {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        color: var(--font-color-light);
    }

    .form-close {
        width: 2.25rem;
        height: 2.25rem;
        border: 3px dashed var(--font-color-light);
        border-radius: 1.5rem;
        font-size: var(--font-size-md); 
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .form-close:hover {
        border: 3px dashed var(--color-yellow);
        color: var(--color-yellow);
    }

    .user-form-input-field {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem 1.5rem 0rem 1.5rem;
    }

    .user-form-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .user-form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn.create {
        width: 100%;
    }
</style>