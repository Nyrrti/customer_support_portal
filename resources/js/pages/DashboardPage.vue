<script setup lang="ts">
    import TicketsOverview from '../../domains/tickets/components/TicketsOverview.vue';
    import LoggedInLayout from '../layouts/LoggedInLayout.vue';
    import TicketCard from '../../domains/tickets/components/TicketCard.vue';
</script>


<template>

    <LoggedInLayout>
        <div class="dashboard-bg">
            <div class="mobile">
                <TicketCard />
            </div>
            <div class="desktop">
                <TicketsOverview />
            </div>  
        </div>
    </LoggedInLayout>

</template>

<style scoped>

    .dashboard-bg {
        min-height: 100%;
        padding: 0.75rem;
        background-color: var(--bg-color-secondary);
        background:
        linear-gradient(
            135deg,
            var(--bg-color-secondary),
            color-mix(in srgb, var(--bg-color-secondary) 95%, rgb(92, 119, 153))
        );
    }

    .mobile {
        display: block;
    }

    .desktop {
        display: none;
    }

    @media (min-width: 1200px) {

        .dashboard-bg {
            padding: 1rem;
        }
       
        .mobile {
            display: none;
        }

        .desktop {
            display: block;
        }
    }
</style>
