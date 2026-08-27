<script setup lang="ts">

</script>


<template>
    <nav class="grid-container-fluid nav-bar">
        <div class="grid-container max-width px-5">
            <div class="col-4">
                <RouterLink to="/" class="logo">
                    <span class="logo-yellow">
                        Tickety
                    </span>
                    Ticker
                </RouterLink>
            </div>
            <div class="col-8 nav-links">
                <RouterLink to="/" class="nav">
                    Home
                </RouterLink>
            </div>
        </div>
       
    </nav>
</template>

<style scoped>

    .nav-bar {
        min-height: 5.25rem;
        background-color: rgba(6, 31, 70, 0.6);
        border-bottom: 1px solid var(--color-yellow);
        display: flex;
        align-items: center;
    }

    .nav-content {
        align-items: center;
    }

    .logo {
        display: flex;
        justify-content: center;
        align-items: center; 
    }

    .logo-yellow {
        color: var(--color-yellow);
        text-transform: uppercase;
        font-size: var(--font-size-xl);
        font-weight: 700;
        letter-spacing: 0.05rem;
    }

    .nav-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .nav {
        font-size: 1.05rem;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        padding: 1.5rem 0 0.1rem;
        border-bottom: 2px dotted var(--color-yellow);
    }

    .nav:hover,
    .nav.router-link-active {
        color: var(--font-color-title-light);
        border-bottom-color: var(--color-yellow);
    }

</style>