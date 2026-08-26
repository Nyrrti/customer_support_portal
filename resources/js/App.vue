

<script setup lang="ts">
import Navigation from './pages/Navigation.vue';

</script>

<template>
    <div class="page-bg">
        <navigation />
        <main class="grid-container-fluid">
            <div class="grid-container max-width px-5">
                <router-view />
            </div>
        </main>
    </div>
</template>