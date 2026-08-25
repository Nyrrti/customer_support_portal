<script setup lang="ts">

</script>


<template>
    <nav class="grid-container-fluid nav-bar">
        <div class="grid-container max-width px-5">
            <div class="wrap d-flex gap-10">
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
        background-color: var(--bg-color-nav);
        min-height: 4rem;
        border-bottom: 1px solid #f2c234;
        display: flex;
        align-items: end;
    }

    .nav {
        display: flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        border-bottom: 2px dotted var(--color-yellow);
        margin-bottom: 0.75rem;
    }

</style>