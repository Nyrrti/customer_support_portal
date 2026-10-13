<script setup lang="ts">
    
    import TicketDetails from '../components/TicketDetails.vue';
    import LoggedInLayout from '../../../js/layouts/LoggedInLayout.vue';
    import ReplyCard from "../../replies/components/ReplyCard.vue"
    
</script>

<template>
    <LoggedInLayout>
        <div class="ticket-detail-background">
            <TicketDetails />
            <ReplyCard />
        </div>
        
    </LoggedInLayout>

</template>

<style scoped>

    .ticket-detail-background {
        background-color: var(--bg-color-dark-blue);
        min-height: 100%;
    }

</style>


