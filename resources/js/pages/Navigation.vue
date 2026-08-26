<script setup lang="ts">

</script>


<template>
    <nav class="grid-container-fluid nav-bar">
        <div class="grid-container max-width px-5">
            <div class="col-3">
                <RouterLink to="/" class="logo">
                    TicketyTicker
                </RouterLink>
            </div>
            <div class="col-6 nav-links">
                <RouterLink to="/" class="nav">
                    Home
                </RouterLink>
                <RouterLink to="/" class="nav">
                    Tickets
                </RouterLink>
            </div>
        </div>
       
    </nav>
</template>

<style scoped>

    .nav-bar {
        min-height: 4.5rem;

        background-color: rgba(4, 14, 30, 0.6);
        border-bottom: 2px solid var(--color-yellow);

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
        gap: 2rem;   
    }

    .nav-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .nav {
        
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        padding: 1.5rem 0 0.6rem;
        border-bottom: 2px dotted var(--color-yellow);
    }

    .nav:hover,
    .nav.router-link-active {
        color: var(--font-color-light);
        border-bottom-color: var(--color-yellow);
    }

</style>