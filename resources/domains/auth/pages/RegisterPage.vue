<script setup lang="ts">
    import LoggedOutLayout from "../../../js/layouts/LoggedOutLayout.vue";
    import RegisterForm from "../components/RegisterForm.vue";
</script>

<template>

    <LoggedOutLayout>
        <div class="register-section">
            <RegisterForm />
        </div>
    </LoggedOutLayout>

</template>

<style scoped>

    .register-section {
        min-height: 100%;
        display: flex;
        justify-content: center;
        background-color: var(--bg-color-secondary);
        background:
        linear-gradient(
            135deg,
            var(--bg-color-secondary),
            color-mix(in srgb, var(--bg-color-secondary) 85%, rgb(92, 119, 153))
        );   
    }

</style>