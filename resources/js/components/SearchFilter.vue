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
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        width: 100%;
    }

    .header-search-bar {
        width: 100%;
    }

    input.search-bar {
        width: 100%;
        box-sizing: border-box;
        background-color: var(--bg-color-sidebar);
        border: 1px solid var(--border-color-blue);
        border-radius: 0.35rem;
        color: var(--font-color-light);
        padding: 0.7rem;
    }

    .button-section {
        display: flex;
        gap: 0.75rem;
    }

    .filter {
        background-color: var(--bg-color-sidebar);
        min-height: 2.5rem;
        border: 1px solid var(--border-color-blue);
        border-radius: 0.5rem;
        color: var(--font-color-light);
        flex: 1;
        
    }

    .select-dark {
        background-color: var(--bg-color-sidebar);
        border: 1px solid var(--border-color-blue);
        color: var(--font-color-light);
        flex: 1;
    }

    @media (min-width: 1200px) {

        .section {
            flex-direction: row;
            align-items: stretch;
            gap: 4rem;
        }

        .header-search-bar {
            flex: 1;
            min-width: 0;
        }

        .button-section {
            flex: 0 0 auto;
            display: flex;
            gap: 0.75rem;
        }

        .filter,
        .select-dark {
            flex: 0 0 auto;
            width: auto;
        }
    }
</style>