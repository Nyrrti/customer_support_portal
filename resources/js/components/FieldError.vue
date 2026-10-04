<script setup lang="ts">

    defineProps<{ errors?: string[] }>();

</script>

<template>
    <p v-for="error in errors" :key="error" class="field-error">
        {{ error }}
    </p>
</template>