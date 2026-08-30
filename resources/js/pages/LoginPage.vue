<script setup lang="ts">
    import LoginSection from '../components/auth/LoginSection.vue';
    import LoggedOutLayout from '../layouts/LoggedOutLayout.vue';
</script>

<template>
    <LoggedOutLayout>
        <LoginSection /> 
    </LoggedOutLayout>
</template>
