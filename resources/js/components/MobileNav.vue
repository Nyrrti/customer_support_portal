<script setup lang="ts">
    import { ref, watch, onMounted, onBeforeUnmount } from "vue";
    import { useRoute, useRouter } from "vue-router";
    import { authStore } from "../../domains/auth/store";

    const route = useRoute();
    const router = useRouter();

    const isOpen = ref(false);
    const navRef = ref<HTMLElement | null>(null);

    function toggleMenu() {
        isOpen.value = !isOpen.value;
    }

    function closeMenu() {
        isOpen.value = false;
    }

    /**
     * Closes the menu after navigating, so it doesn't stay open
     * on top of the new page.
     */
    watch(() => route.fullPath, closeMenu);

    /**
     * Closes the menu when the user clicks anywhere outside it.
     */
    function handleClickOutside(event: MouseEvent) {
        if (isOpen.value && navRef.value && !navRef.value.contains(event.target as Node)) {
            closeMenu();
        }
    }

    /**
     * Closes the menu with the Escape key.
     */
    function handleKeydown(event: KeyboardEvent) {
        if (event.key === "Escape") {
            closeMenu();
        }
    }

    onMounted(() => {
        document.addEventListener("click", handleClickOutside);
        document.addEventListener("keydown", handleKeydown);
    });

    onBeforeUnmount(() => {
        document.removeEventListener("click", handleClickOutside);
        document.removeEventListener("keydown", handleKeydown);
    });

    async function handleLogout() {
        closeMenu();
        await authStore.logout();
        router.push("/");
    }
</script>

<template>
    <nav ref="navRef" class="nav-section" aria-label="Main navigation">
        <button
            type="button"
            class="menu-toggle"
            :class="{ open: isOpen }"
            :aria-expanded="isOpen"
            aria-controls="mobile-nav-menu"
            :aria-label="isOpen ? 'Close menu' : 'Open menu'"
            @click="toggleMenu"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="22"
                height="22"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                aria-hidden="true"
            >
                <template v-if="isOpen">
                    <path d="M6 6l12 12M18 6L6 18" />
                </template>
                <template v-else>
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </template>
            </svg>
        </button>

        <Transition name="dropdown">
            <div v-if="isOpen" id="mobile-nav-menu" class="nav-mobile-menu">
                <div class="nav-list">
                    <RouterLink to="/dashboard" class="nav-item" active-class="active">
                        <span class="nav-icon">⌂</span>
                        <span>Dashboard</span>
                    </RouterLink>

                    <RouterLink to="/tickets" class="nav-item" active-class="active">
                        <span class="nav-icon">T</span>
                        <span>Tickets</span>
                    </RouterLink>

                    <RouterLink to="/tickets/create" class="nav-item" active-class="active">
                        <span class="nav-icon">+</span>
                        <span>Create Ticket</span>
                    </RouterLink>

                    <template v-if="authStore.user?.is_admin">
                        <span class="nav-group-label">Admin</span>

                        <RouterLink to="/users" class="nav-item" active-class="active">
                            <span class="nav-icon">○</span>
                            <span>Users</span>
                        </RouterLink>

                        <RouterLink to="/categories" class="nav-item" active-class="active">
                            <span class="nav-icon">□</span>
                            <span>Categories</span>
                        </RouterLink>
                    </template>
                </div>

                <div class="logout-section">
                    <button type="button" class="logout-button" @click="handleLogout">
                        <span class="nav-icon">↪</span>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </Transition>
    </nav>
</template>

<style scoped>

    .nav-section {
        --nav-item-height: 3rem;
        --nav-radius: 0.5rem;
        --menu-width: 16rem;

        position: relative;
        display: flex;
        align-items: center;
        margin-right: 1rem;
    }

    /* Mobile Nav Icon */
    .menu-toggle {
        width: 2.75rem;
        height: 2.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        background-color: transparent;
        border: 2px solid var(--font-color-medium-light);
        border-radius: 0.4rem;
        color: var(--font-color-light);
        cursor: pointer;
        transition:
            border-color 0.15s ease,
            color 0.15s ease;
    }

    .menu-toggle:hover,
    .menu-toggle.open {
        border-color: var(--color-yellow);
        color: var(--color-yellow);
    }

    .menu-toggle:focus-visible {
        outline: 2px solid var(--color-yellow);
        outline-offset: 2px;
    }

    /* Dropdown menu */
    .nav-mobile-menu {
        position: absolute;
        top: calc(100% + 0.75rem);
        left: 0;
        z-index: 50;
        width: var(--menu-width);
        max-width: calc(100vw - 2rem);
        display: flex;
        flex-direction: column;
        padding: 0.75rem;
        border: 1px solid var(--border-color-dark-blue);
        border-radius: 0.6rem;
        box-shadow: 0 0.9rem 2rem rgba(15, 29, 51, 0.5);
        background:
            radial-gradient(
                ellipse 250% 60% at -10% -10% in oklab,
                rgba(37, 80, 146, 1) 12%,
                rgba(49, 66, 148, 0.95) 26%,
                rgba(66, 50, 144, 0.85) 42%,
                rgba(66, 50, 144, 0) 76%
            ),
            var(--bg-color-sidebar);
    }

    .nav-list {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .nav-group-label {
        margin: 0.6rem 0.9rem 0.2rem;
        color: var(--font-color-medium-light);
        font-size: var(--text-caption);
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        opacity: 0.7;
    }

    .nav-item {
        min-height: var(--nav-item-height);
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.65rem 0.9rem;
        border-radius: var(--nav-radius);
        color: var(--font-color-medium-light);
        font-size: var(--text-link);
        font-weight: 500;
        transition:
            background-color 0.15s ease,
            color 0.15s ease;
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
                color-mix(in srgb, var(--bg-color-sidebar) 55%, var(--color-blue)),
                color-mix(in srgb, var(--bg-color-sidebar) 65%, var(--color-purple))
            );
        color: var(--font-color-light);
    }

    .nav-icon {
        width: 1.4rem;
        display: flex;
        justify-content: center;
        flex-shrink: 0;
        color: inherit;
    }

    .logout-section {
        margin-top: 0.75rem;
        padding-top: 0.75rem;
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

    .dropdown-enter-active,
    .dropdown-leave-active {
        transition:
            opacity 0.15s ease,
            transform 0.15s ease;
    }

    .dropdown-enter-from,
    .dropdown-leave-to {
        opacity: 0;
        transform: translateY(-0.5rem);
    }

    @media (min-width: 1200px) {
        .nav-section {
            display: none;
        }
    }
</style>