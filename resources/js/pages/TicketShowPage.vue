<script setup lang="ts">
    import TicketDetails from '../components/ticket/TicketDetails.vue';
    import LoggedInLayout from '../layouts/LoggedInLayout.vue';

    const ticket = {
        id: 1008,
        subject: "Unable to login",
        category: "Account Access",
        status: "In progress",
        createdBy: "Sophia Carter",
        createdAt: "30 Aug 2026, 14:22",
        updatedAt: "30 Aug 2026, 14:37",
        assignedTo: "Olivia Rhye",
        description:
            "After entering my email and password, the page reloads and returns me to the login screen.",
    };
</script>

<template>

    <LoggedInLayout>
        <div class="dashboard-bg">
            <TicketDetails :ticket="ticket" />
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