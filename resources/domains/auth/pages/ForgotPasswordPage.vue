<script setup lang="ts">
    import LoggedOutLayout from "../../../js/layouts/LoggedOutLayout.vue";
    import ForgotPasswordForm from "../components/ForgotPasswordForm.vue";


</script>

<template>

    <LoggedOutLayout>
        <div class="forgotpassword-section">
            <ForgotPasswordForm />
        </div>
    </LoggedOutLayout>

</template>

<style scoped>

    .forgotpassword-section {
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