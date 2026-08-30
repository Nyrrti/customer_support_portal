<script setup lang="ts">
    import PortalHeader from '../components/layout/PortalHeader.vue';
    import PortalIntroSidebar from '../components/layout/PortalIntroSidebar.vue';
</script>

<template>
    <div class="page-bg">
        <div class="portal">
            <PortalHeader>
                <div class="d-flex items-center gap-3">
                    <RouterLink to="/login">
                        Login
                    </RouterLink>

                    <RouterLink to="/register" class="btn">
                        Register
                    </RouterLink>
                </div>
            </PortalHeader>
            <main class="grid-container portal-content">
                <aside class="col-12 col-lg-5">
                    <PortalIntroSidebar />
                </aside>

                <section class="col-12 col-lg-7 logged-out-content">
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
        --portal-max-width: 110rem;
        --portal-shadow: 0 0.9rem 2rem rgba(15, 29, 51, 0.5);

        width: 100%;
        max-width: var(--portal-max-width);
        margin-inline: auto;
        max-width: var(--portal-max-width);
        border: 1px solid var(--bg-color-header);
        overflow: hidden;
        box-shadow: var(--portal-shadow);
        display: flex;
        flex-direction: column;
        /* min-height: calc(100dvh - 1.3rem); */
        min-height: 100dvh;
    }

    .portal-content {
        flex: 1;
    }

    .portal-login {
        background-color: var(--bg-color-card);
    }

    @media (min-width: 768px) {
        .portal {
            width: min(110rem, calc(100% - 2rem));
        }
    }
</style>