
<script setup lang="ts">
    import { onMounted } from "vue";
    import { authStore } from '../domains/auth/store';

    onMounted(async () => {
        await authStore.getUser();
    });

</script>

<template>
    <RouterView />
</template>