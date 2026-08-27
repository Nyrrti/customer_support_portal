<template>
    <div class="sidebar-content">
        <div>
            <p class="brand-title">
                TICKETYTICKER
            </p>

            <h1 class="light">
                Manage events and tickets with ease
            </h1>

            <p class="sidebar-text">
                Submit, track and resolve support tickets quickly and efficiently.
            </p>
        </div>

        <div class="sidebar-footer">
            <p class="caption">
                Simple event management.
            </p>
        </div>
    </div>
</template>

<style scoped>
    .sidebar-content {
        --sidebar-padding: 3rem;
        --sidebar-gap: 1.5rem;

        min-height: 100%;
        padding: var(--sidebar-padding);

        display: flex;
        flex-direction: column;
        justify-content: space-between;

        background-color: var(--bg-color-sidebar);
    }

    .brand-title {
        margin-bottom: var(--sidebar-gap);
        color: var(--color-yellow);
        font-size: var(--font-size-xs);
        font-weight: 700;
        letter-spacing: 0.12rem;
    }

    .sidebar-text {
        max-width: 28rem;
        margin-top: var(--sidebar-gap);

        color: var(--font-color-medium);
    }

    .sidebar-footer p {
        color: var(--font-color-medium);
    }
</style>