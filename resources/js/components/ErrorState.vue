<script setup>
    import { useFieldError } from '../composables/useFieldError';
    import { ref } from 'vue';

    const {errors, getError, setErrors, clearError, clearErrors} = useFieldError()
    const email = ref("");

    function showExampleErrors() {
        const exampleErrors = {
            email: "Email is required",
            password: "Password is too short"
        };

        setErrors(exampleErrors);
    }

    const response = {
        errors: {
            name: ["Name is required"],
            email: ["Email is required"],
            password: ["Password is too short"]
        }
    };
</script>

<template>
    <div class="error-bg my-2 p-3">
        <div class="button-section">
            <button @click="showExampleErrors" class="btn">
                Show both errors
            </button> 
            <button @click="showExampleErrors" class="btn">
                Show All
            </button> 
            <button @click="clearError('password')" class="btn delete">
                Clear error
            </button> 
            <button @click="clearErrors" class="btn delete">
                Clear all errors
            </button> 
            <p class="light">
                {{ getError("email") }}
            </p> 
            <p class="light">
                {{ errors.password }}
            </p>
        </div>
        <div class="form-section">
            <input 
                v-model="email"
                type="email"
                placeholder="Email"
                @input="clearError('email')"
            />
            <p class="light">
                {{ getError("email") }}
            </p>
        </div>
        
    </div>

</template>

<style scoped>

    .error-bg {
        --horizontal-gap: 0.8rem;
        --vertical-gap: 0.5rem;

        display: flex;
        flex-direction: column;
        background-color: var(--bg-color-blue);
        row-gap: var(--horizontal-gap);
    }

    .button-section, .form-section {
        display: flex;
        row-gap: var(--horizontal-gap);
        column-gap: var(--vertical-gap);
    }
</style>