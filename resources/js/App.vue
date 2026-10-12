
<script setup lang="ts">
    import { onMounted } from "vue";
    import { authStore } from '../domains/auth/store';
    import ErrorMessage from "./components/ErrorMessage.vue";
   

    onMounted(async () => {
        await authStore.getUser();
    });

</script>

<template>
    <ErrorMessage />
    <RouterView />
</template>