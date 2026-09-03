<script setup lang="ts">



</script>

<template>
    <div class="ticket-bg p-4">
            <div class="ticket-heading py-2">
                <div class="ticket-icon">
                    T
                </div>
                <div>
                    <h5>
                        Create new ticket
                    </h5>
                </div>
            </div>
            <div class="ticket-input-field">
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
            <button class="btn login" type="submit">
                Add
            </button>
    </div>
</template>

<style scoped>

    .ticket-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 0.5rem 1.5rem rgba(15, 29, 51, 0.07);
    }

    .ticket-heading {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .ticket-heading p {
        color: var(--font-color-medium-dark);
        font-size: var(--font-size-xxs);
    }

    .ticket-icon {
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

    .ticket-input-field {
        display: flex;
        flex-direction: column;
        gap:0.5rem;
    }

    .ticket-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .bottom-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .bottom-row a {
        font-size: var(--font-size-xxs);
        color: var(--color-blue);
        font-weight: 500;
    }

    .btn.login {
        width: 100%;
    }
</style>