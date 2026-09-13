<script setup lang="ts">

</script>


<template>
    <header class="header">
        <div class="brand-field">
            <span class="brand-icon">
                TT
            </span>
            >>
            <RouterLink to="/" class="brand-name">
                Tickety<span>Ticker</span>
            </RouterLink>
        </div>  
        <div class="header-search">
            <slot name="search" />
        </div>
        <div class="header-user-profile">
            <slot name="user-profile" />
        </div>
    </header>
</template>

<style scoped>

    .header {
        --header-height: 5.25rem;
        --header-padding-x: 2rem;
        --header-gap: 2rem;
        --brand-gap: 0.75rem;
        --brand-icon-size: 2.5rem;

        min-height: var(--header-height);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-inline: var(--header-padding-x);
        background-color: var(--bg-color-header);
        border-bottom: 1px solid var(--border-color-blue);
    }

    .header-grid {
        align-items: center;
    }

    .header-user-profile {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .brand-field {
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
        font-size: var(--text-caption);
        font-weight: 700;
    }

    .brand-name {
        color: var(--font-color-light);
        font-family: var(--font-family-title);
        font-size: var(--text-section-title);
        font-weight: 700;
    }

    .brand-name span {
        color: var(--color-yellow);
    }

    @media (min-width: 768px) {

        .header {
            --header-padding-x: 1rem;
            --header-gap: 1rem;
        }

        .brand-field {
            flex-shrink: 0;
        }

        .header-search {
            flex: 1;
            min-width: 0;
            display: flex;
            justify-content: center;
        }

        .brand-name {
            font-size: var(--text-page-title);
        }
    }

</style>