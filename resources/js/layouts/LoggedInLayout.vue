<script setup lang="ts">
    import PortalHeader from "../components/PortalHeader.vue";
    import PortalNavSidebar from "../components/PortalNavSidebar.vue";
    import UserProfileMenu from "../components/UserProfileMenu.vue";
    
import MobileNav from "../components/MobileNav.vue";
</script>


<template>

    <div class="page-bg">
        <div class="portal">
            <portal-header>
                <template #nav-mobile>
                    <mobile-nav />
                </template>
                <template #user-profile>
                    <user-profile-menu />
                </template>
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
        --portal-max-width: 110rem;
        --portal-shadow: 0 0.9rem 2rem rgba(15, 29, 51, 0.5);

        width: 100%;
        max-width: var(--portal-max-width);
        margin-inline: auto;
        border: 1px solid var(--bg-color-header);
        box-shadow: var(--portal-shadow);
        display: flex;
        flex-direction: column;
        min-height: 100dvh;
        overflow: hidden;
    }

    .portal-nav {
        display: none;
    }

    .portal-main {
        min-width: 0;
    }

    .portal-content {
        flex:1;
        display: grid;
        grid-template-columns: minmax(0, 1fr);
    }

    .portal-login {
        background-color: var(--bg-color-card);
    }

    @media (min-width: 768px) {
       
    }

    @media (min-width: 1200px) {
         .portal {
            width: min(110rem, calc(100% - 2rem));
        }

        .portal-content {
            grid-template-columns:
                clamp(14rem, 18vw, 17rem)
                minmax(0, 1fr);
        }

        .portal-nav {
            display: block;
        }
    }
</style>