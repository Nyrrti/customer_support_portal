<script setup lang="ts">
    import { ref } from "vue";

    const isOpen = ref(false)
    const toggleMenu = () => {
        isOpen.value = !isOpen.value
    }


</script>

<template>
    <nav class="nav-section">
        <button @click="toggleMenu" class="mobile">
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="22px" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div v-if="isOpen" class="nav-mobile-links">
            <RouterLink
                to="/tickets"
                class="nav-item"
                active-class="active"
            >
                Tickets
            </RouterLink>
        </div>
    </nav>

    
</template>

<style scoped>

        .nav-section {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--font-color-medium-light);
        }

        .nav-mobile-links {
            display: flex;
            position: absolute;
            top: 3rem;
            left: 0rem;
            flex-direction: column;
            background-color: var(--bg-color-sidebar);
            border: 1px solid var(--border-input);
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

        .mobile {
            width: 3rem;
            height: 3rem;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            border: 1px solid var(--font-color-light);
            border-radius: 0.4rem;
            color: var(--font-color-light);
        }


</style>