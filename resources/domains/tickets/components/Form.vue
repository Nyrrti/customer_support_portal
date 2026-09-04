<script setup lang="ts">



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
    <div class="ticket-form-bg">
        <div class="ticket-form-heading p-4">
            <div class="ticket-form-icon">
                C
            </div>
            <div>
                <h5>
                    Create new ticket
                </h5>
            </div>
        </div>
        <div class="ticket-form-input-field p-4">
            <div class="field">
                <label for="subject">
                    Subject
                </label>
                <input 
                    id="subject"
                    v-model="subject"
                    type="input"
                >
            </div>
            <div class="field">
                <label for="description">
                    Description
                </label>
                <textarea
                    id="description"
                    v-model="description"
                    type="input"
                >
                </textarea>
            </div>
        </div>
        <div class="ticket-form-footer p-4">
            <button class="btn create" type="submit">
                Create Ticket
            </button>
        </div>
    </div>
</template>

<style scoped>

    .nav-link span {
        color: var(--font-color-medium-dark);
    }

    .ticket-form-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--bg-color-card-dark);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .ticket-form-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        border-radius: 0.6rem 0.6rem 0 0;
        background: var(--bg-color-card-dark);
        background: linear-gradient(150deg, 
            rgb(119, 70, 182) 0%, 
            rgb(69, 102, 163) 40%, 
            rgb(69, 102, 163) 60%, 
            rgb(31, 114, 155) 100%
        );   
    }

    .ticket-form-heading h5 {
        color: var(--font-color-light);
    }

    .ticket-form-icon {
        width: 3rem;
        height: 3rem;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--color-blue);
        color: var(--font-color-light);
        border-radius: 0.75rem;
    }

    .ticket-form-input-field {
        display: flex;
        flex-direction: column;
        gap:0.5rem;
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