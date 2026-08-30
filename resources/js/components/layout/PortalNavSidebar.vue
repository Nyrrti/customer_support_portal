<script setup lang="ts"></script>

<template>
    <aside class="portal-nav">
        <nav class="nav-list">

            <RouterLink
                to="/dashboard"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">⌂</span>
                <span>Dashboard</span>
            </RouterLink>

            <RouterLink
                to="/tickets"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">T</span>
                <span>Tickets</span>
            </RouterLink>

            <RouterLink
                to="/my-tickets"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">○</span>
                <span>My Tickets</span>
            </RouterLink>

            <RouterLink
                to="/tickets/create"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">+</span>
                <span>Create Ticket</span>
            </RouterLink>

            <RouterLink
                to="/notes"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">≡</span>
                <span>Notes</span>
            </RouterLink>

            <RouterLink
                to="/users"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">○</span>
                <span>Users</span>
            </RouterLink>

            <RouterLink
                to="/categories"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">□</span>
                <span>Categories</span>
            </RouterLink>

            <RouterLink
                to="/settings"
                class="nav-item"
                active-class="active"
            >
                <span class="nav-icon">⚙</span>
                <span>Settings</span>
            </RouterLink>

        </nav>

        <div class="logout-section">
            <button class="logout-button">
                <span class="nav-icon">↪</span>
                <span>Logout</span>
            </button>
        </div>
    </aside>
</template>

<style scoped>

    .portal-nav {
    --nav-padding: 1.5rem;
    --nav-gap: 0.5rem;
    --nav-item-height: 3rem;
    --nav-radius: 0.5rem;

    min-height: 100%;
    display: flex;
    flex-direction: column;
    padding: var(--nav-padding);
    background-color: var(--bg-color-sidebar);
    background:
        radial-gradient(
            ellipse 250% 60% at -10% -10% in oklab,
            rgba(37, 80, 146, 1) 12%,
            rgba(49, 66, 148, 0.95) 26%,
            rgba(66, 50, 144, 0.85) 42%,
            rgba(66, 50, 144, 0.35) 60%,
            rgba(66, 50, 144, 0) 76%
        ),

        radial-gradient(
            ellipse 250% 40% at 115% 108% in oklab,
            rgba(3, 135, 145, 0.42) 0%,
            rgba(4, 117, 143, 0.38) 20%,
            rgba(12, 96, 140, 0.35) 40%,
            rgba(37, 80, 146, 0.2) 58%,
            rgba(37, 80, 146, 0) 76%
        ),

        var(--bg-color-sidebar);
}

    .nav-list {
        display: flex;
        flex-direction: column;
        gap: var(--nav-gap);
    }

    .nav-item {
        min-height: var(--nav-item-height);

        display: flex;
        align-items: center;
        gap: 0.9rem;

        padding: 0.65rem 0.9rem;

        border-radius: var(--nav-radius);

        color: var(--font-color-medium-light);

        font-size: var(--font-size-xs);
        font-weight: 500;

        transition:
            background-color 0.15s ease,
            color 0.15s ease;
    }

    .nav-icon {
        width: 1.4rem;
        display: flex;
        justify-content: center;
        flex-shrink: 0;
        color: inherit;
    }

    .nav-item:hover {
        background-color:
            color-mix(
                in srgb,
                var(--bg-color-sidebar) 60%,
                var(--color-blue)
            );
        color: var(--font-color-light);
    }

    .nav-item.active {
        background:
            linear-gradient(
                135deg,
                color-mix(
                    in srgb,
                    var(--bg-color-sidebar) 55%,
                    var(--color-blue)
                ),
                color-mix(
                    in srgb,
                    var(--bg-color-sidebar) 65%,
                    var(--color-purple)
                )
            );

        color: var(--font-color-light);
    }

    .logout-section {
        margin-top: auto;
        padding-top: 1.25rem;
        border-top: 1px solid
            color-mix(
                in srgb,
                var(--font-color-medium-light) 18%,
                transparent
            );
    }

    .logout-button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.65rem 0.9rem;
        background: none;
        border: 0;
        border-radius: var(--nav-radius);
        color: var(--font-color-medium-light);
        font: inherit;
        cursor: pointer;
    }

    .logout-button:hover {
        color: var(--color-yellow);
    }

</style>