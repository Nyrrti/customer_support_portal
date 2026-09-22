<script setup lang="ts">
    import TicketDetails from '../components/TicketDetails.vue';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';
</script>

<template>

    <LoggedInLayout>
        <div class="ticket-page-background">
            <TicketDetails :ticket="ticket" />
        </div>
    </LoggedInLayout>

</template>


<style scoped>

    .ticket-page-background {
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