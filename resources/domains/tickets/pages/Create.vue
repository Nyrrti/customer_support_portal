<script setup lang="ts">
    import { ref } from 'vue';

    import Form from '../components/Form.vue';
    import { createTicket } from '../ticketstore.js';
    import { useRouter } from 'vue-router';

    const router = useRouter();

    const ticket = ref({
        subject: '',
        description: '',
    });

    const handleSubmit = async (data) => {
        await createTicket(data);
        router.push({name: 'tickets.overview'});
    };
</script>

<template>
    <div class="dashboard-bg">
        <h2>
            Create new ticket
        </h2>
        <Form :ticket="ticket" @submit="handleSubmit" />
    </div>
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

</style>