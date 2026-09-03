<script setup lang="ts">
    import TicketsOverview from '../../domains/tickets/components/TicketsOverview.vue';
    import LoggedInLayout from '../layouts/LoggedInLayout.vue';
</script>


<template>

    <LoggedInLayout>
        <div class="dashboard-bg">
            <TicketsOverview />
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

</style>
