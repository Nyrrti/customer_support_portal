<script setup lang="ts">

</script>


<template>
    <header class="portal-header">
        <div class="grid-container header-grid">
            <div class="row">
                <div class="col-12 col-lg-3 brand-box">
                    <span class="brand-icon">
                        TT
                    </span>
                    >>
                    <RouterLink to="/" class="brand-name">
                        Tickety<span>Ticker</span>
                    </RouterLink>
                </div>  
                <div class="col-12 col-lg-9 header-actions">
                    <slot />
                </div>
            </div>
        </div>
    </header>
</template>

<style scoped>

    .portal-header {
        --header-height: 5.25rem;
        --header-padding-x: 2rem;
        --header-gap: 2rem;
        --brand-gap: 0.75rem;
        --brand-icon-size: 2.5rem;

        min-height: var(--header-height);
        display: flex;
        align-items: center;
        padding-inline: var(--header-padding-x);
        background-color: var(--bg-color-header);
        border-bottom: 1px solid var(--border-color-blue);
    }

    .header-grid {
        align-items: center;
    }

    .header-actions {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 1rem;
    }

    .brand-box {
        display: flex;
        align-items: center;
        gap: var(--brand-gap);
        color: var(--color-blue);
    }

    .brand {
        gap: var(--brand-gap);
    }

    .brand-icon {
        width: var(--brand-icon-size);
        height: var(--brand-icon-size);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        color: var(--font-color-light);
        border: 5px solid var(--color-blue);
        border-radius: 0.3rem;
        font-size: var(--font-size-caption);
        font-weight: 700;
    }

    .brand-name {
        color: var(--font-color-light);
        font-family: var(--font-family-title);
        font-size: var(--font-size-lg);
        font-weight: 700;
    }

    .brand-name span {
        color: var(--color-yellow);
    }

    @media (max-width: 600px) {

        .portal-header {
            --header-padding-x: 1rem;
            --header-gap: 1rem;
        }

        .brand-name {
            font-size: var(--font-size-md);
        }
    }

</style>