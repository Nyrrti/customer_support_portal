<script setup lang="ts">
    import { ref } from 'vue';
    import Form from '../components/Form.vue';
    import { ticketStore } from '../store.js';
    import { useRouter } from 'vue-router';
    import type { CreateTicket } from '../types.js';
import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';

    const router = useRouter();

    const ticket = ref({
        subject: '',
        description: '',
    });

    const handleSubmit = async (data: CreateTicket) => {
        await ticketStore.actions.create(data);
        router.push({name: 'tickets'});
    };
</script>

<template>
    <LoggedInLayout>
        <div class="dashboard-bg">
            <div class="form-wrapper py-3">
                <Form :ticket="ticket" @submit="handleSubmit" />
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