<script setup lang="ts"></script>

<template>
    <div class="header-search-bar">
        <input class="search-bar" placeholder="Search">
    </div>
</template>

<style scoped>

    .header-search-bar {
        width: min(30rem, 100%);
    }

    input.search-bar {
        width: 100%;
        background-color: var(--bg-color-sidebar);
        border: 1px solid var(--border-color-blue);
        border-radius: 0.35rem;
        color: var(--font-color-light);
        padding: 0.7rem;
        width: 100%;
    }

</style>