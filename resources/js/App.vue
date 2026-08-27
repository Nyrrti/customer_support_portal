

<script setup lang="ts">
import Navigation from './pages/Navigation.vue';

</script>

<template>
    <div class="page-bg">
        <navigation />
        <main>
            <router-view />
        </main>
    </div>
</template>