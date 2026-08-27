<script setup lang="ts">
    import PortalHeader from '../components/PortalHeader.vue';
    import PortalSidebar from '../components/PortalSidebar.vue';
</script>

<template>
    <div class="page-bg">
        <div class="portal">
            <PortalHeader />
            <main class="grid-container portal-content">
                <section class="col-12 col-lg-5 portal-sidebar">
                    <PortalSidebar />
                </section>
                <section class="col-12 col-lg-7 portal-login">
                    Login Section
                </section>
            </main>
        </div>
    </div>
</template>

<style scoped>

    .page-bg {
        display: flex;
        justify-content: center;
        padding: 1rem;
    }

    .portal {
        --portal-max-width: 95rem;
        --portal-radius: 1rem;
        --portal-shadow: 0 1rem 3rem rgba(15, 29, 51, 0.5);

        width: 100%;
        max-width: var(--portal-max-width);
        border-radius: var(--portal-radius);
        overflow: hidden;
        box-shadow: var(--portal-shadow);
    }

    .portal-content {
        min-height: calc(100dvh - 8.5rem);
    }

    .portal-login {
        background-color: var(--bg-color-primary);
    }
</style>