<script setup lang="ts">

    import PortalHeader from '../components/layout/PortalHeader.vue';
import PortalNavSidebar from '../components/layout/PortalNavSidebar.vue';

</script>


<template>

    <div class="page-bg">
        <div class="portal">
            <portal-header>

            </portal-header>
            <main class="grid-container portal-content">
                <aside class="portal-nav">
                    <portal-nav-sidebar />
                </aside>

                <section class="portal-main">
                    <slot />
                </section>
            </main>  
        </div>
    </div>

</template>

<style scoped>

    .page-bg {
        min-height: 100dvh;
        display: flex;
        justify-content: center;
        align-items: start;
    }

    .portal {
        --portal-max-width: 90rem;
        --portal-shadow: 0 1rem 2.5rem rgba(15, 29, 51, 0.5);

        width: 100%;
        max-width: var(--portal-max-width);
        border: 1px solid var(--bg-color-header);
        overflow: hidden;
        box-shadow: var(--portal-shadow);
        display: flex;
        flex-direction: column;
        min-height: 100dvh;
    }

    .portal-content {
        flex:1;
        display: grid;
        grid-template-columns: clamp(12rem, 18vw, 17rem) 1fr;
    }

    .portal-login {
        background-color: var(--bg-color-card);
    }

</style>