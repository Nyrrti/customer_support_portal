<script setup lang="ts">
import { ref } from 'vue';
import { CreateTicket } from '../types';
import type { Category } from '../../categories/types';

    const props = defineProps<{
        categories: Category[];
    }>();
    
    const ticket = ref<CreateTicket>({
        subject: "",
        description: "",
        category_id: null,
    });

    /**
     * Defines the custom events this component can emit.
     * Describes which event can leave the component
     * Describes what data that event carries
     * Send out
     *
     * The "submit" event must include one CreateTicket object.
     */
    const emit = defineEmits<{
        submit: [ticket: CreateTicket]
    }>();

    /**
     * Handles submitting the ticket form.
     *
     * Emits the current CreateTicket data to the parent component,
     * where it can be sent to the store/API.
     *
     * @returns void
     */
    const submitForm = () => {
        emit("submit", ticket.value);
    };
</script>

<template>
    <div class="nav-link my-2 p-2">
        <RouterLink :to="{ name: 'dashboard' }">
            Tickets 
        </RouterLink>
        <span>
            > Create new Ticket
        </span>
    </div>
    <form class="ticket-form-bg"  @submit.prevent="submitForm">
        <div class="ticket-form-heading p-4">
            <div class="d-flex items-center">
                <div class="ticket-form-icon me-1" aria-hidden="true">
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
                    Create new ticket
                </h5>
            </div>
            <RouterLink
                :to="{ name: 'dashboard' }"
                class="ticket-form-icon form-close"
                aria-label="Back to ticket overview"
            >
                ↩
            </RouterLink>
        </div>
        <div class="ticket-form-input-field">
            <div class="field">
                <label for="subject">
                    Subject
                </label>
                <input 
                    id="subject"
                    v-model="ticket.subject"
                    type="text"
                >
            </div>
            <div class="field">
                <label for="category">
                    Category
                </label>
                <select 
                    id="category"
                    v-model="ticket.category_id" 
                    required
                >
                    <option :value="null" disabled>
                        -- Please select a category --
                    </option>

                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.title }}
                    </option>
                </select>
            </div>
            <div class="field">
                <label for="description">
                    Description
                </label>
                <textarea
                    id="description"
                    v-model="ticket.description"
                >
                </textarea>
            </div>
        </div>
        <div class="ticket-form-footer p-4">
            <button class="btn create" type="submit">
                Create Ticket
            </button>
        </div>
    </form>
</template>

<style scoped>

    .nav-link span {
        color: var(--font-color-medium-dark);
    }

    .ticket-form-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--bg-color-card-dark);
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .ticket-form-heading {
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

    .ticket-form-heading h5 {
        color: var(--font-color-light);
    }

    .ticket-form-icon {
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

    .ticket-form-input-field {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem 1.5rem 0rem 1.5rem;
    }

    .ticket-form-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .tick-form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn.create {
        width: 100%;
    }
</style>