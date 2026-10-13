<script setup lang="ts">
    
    import TicketDetails from '../components/TicketDetails.vue';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';
    import RepliesOverview from "../../replies/components/RepliesOverview.vue"
    
</script>

<template>
    <LoggedInLayout>
        <div class="ticket-detail-background">
            <TicketDetails />
            <RepliesOverview />
        </div>
        
    </LoggedInLayout>

</template>

<style scoped>

    .ticket-detail-background {
        display: flex;
        flex-direction: column;
        background-color: var(--bg-color-dark-blue);
        min-height: 100%;
        padding: 0.5rem;
        gap: 1rem;
    }

    @media (min-width: 1200px) {

        .ticket-detail-background {
            padding: 1.5rem;
            gap: 1.25rem;
        }
    }
</style>


