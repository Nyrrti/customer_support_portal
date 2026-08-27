<script setup lang="ts">

</script>


<template>
    <header class="portal-header">
        <div class="grid-container header-grid">
            <div class="col-12 d-flex justify-between items-center">
                <a href="/" class="brand d-flex items-center">
                    <span class="brand-icon">
                        TT
                    </span>
                    >>
                    <span class="brand-name">
                        Tickety<span>Ticker</span>
                    </span>
                </a>
                <nav>
                    <ul class="d-flex items-center header-links">
                        <li>
                            <a href="/login">
                                Login
                            </a>
                        </li>

                        <li>
                            <a href="/register" class="btn">
                                Register
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>

<style scoped>

    .portal-header {
        --header-height: 5rem;
        --header-padding-x: 2rem;
        --header-gap: 2rem;
        --brand-gap: 0.75rem;
        --brand-icon-size: 2rem;

        min-height: var(--header-height);
        display: flex;
        align-items: center;
        padding-inline: var(--header-padding-x);
        background-color: var(--bg-color-header);
        border-bottom: 1px solid var(--border-input);
    }

    .header-grid {
        align-items: center;
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
        background-color: var(--color-blue);
        color: var(--font-color-light);
        border-radius: 0.35rem;
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

    .header-links {
        gap: var(--header-gap);
    }

    .header-links a:not(.btn) {
        font-size: var(--font-size-xs);
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