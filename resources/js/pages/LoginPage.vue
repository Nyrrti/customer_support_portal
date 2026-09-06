<script setup lang="ts">
    import LoginSection from "../../domains/auth/components/LoginSection.vue";
    import LoggedOutLayout from '../layouts/LoggedOutLayout.vue';
</script>

<template>
    <LoggedOutLayout>
        <LoginSection /> 
    </LoggedOutLayout>
</template>
