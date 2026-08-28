<script setup lang="ts">
    import LoginSection from '../components/LoginSection.vue';
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
                    <LoginSection />
                </section>
            </main>
        </div>
    </div>
</template>

<style scoped>

    .page-bg {
        min-height: 100dvh;
        padding: 0.75rem;
        display: flex;
        justify-content: center;
        align-items: center;
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
        display: flex;
        flex-direction: column;
        min-height: calc(100dvh - 1.5rem);
    }

    .portal-content {
        flex: 1;
    }

    .portal-login {
        background-color: var(--bg-color-primary);
    }
</style>