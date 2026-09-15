<script setup lang="ts"></script>

<template>
    <div class="section">
        <div class="header-search-bar">
            <input class="search-bar" placeholder="Search">
        </div>
        <div class="button-section">
            <button class="btn filter">
               &#9947; Filters
            </button>
            <select class="select-dark">
                <option>
                    Newest Created
                </option>
            </select>
        </div>
    </div>
</template>

<style scoped>

    .section {
        display: grid;
        gap: 0.6rem;
    }

    .header-search-bar {
        display: flex;
        justify-content: center;
        width: min(30rem, 100%);
    }

    input.search-bar {
        width: 100%;
        background-color: var(--bg-color-sidebar);
        border: 1px solid var(--border-color-blue);
        border-radius: 0.35rem;
        color: var(--font-color-light);
        padding: 0.7rem;
    }

    .button-section {
        display: flex;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .filter {
        background-color: var(--bg-color-sidebar);
        min-height: 2.5rem;
        border: 2px solid var(--border-color-blue);
        border-radius: 0.5rem;
        flex: 1;
        color: var(--font-color-light);
    }

    .select-dark {
        background-color: var(--bg-color-sidebar);
        border: 1px solid var(--border-color-blue);
        color: var(--font-color-light);
        flex: 1;
    }

    @media (min-width: 1200px) {

        .section {
            display: flex;
            gap: 2rem;
        }
    }
</style>