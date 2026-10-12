<script setup lang="ts">

    /**
     * Receives the error messages for one field from the parent.
     * The prop is optional because a field may have no errors.
     */
    defineProps<{
        errors?: string[];
    }>();

    /** Requests that the parent clears this field's errors. */
    const emit = defineEmits<{
        dismiss: [];
    }>();
</script>

<template>
    <div v-if="errors?.length" class="field-error">
        <div role="alert">
            <p v-for="error in errors" :key="error">
                {{ error }}
            </p>
    </div>
    <button
        class="btn remove-error"
        type="button"
        aria-label="Dismiss error messages"
        @click="emit('dismiss')"
    >
        <div class="icon">
            ×
        </div>  
    </button>
    </div>
</template>


<style scoped>

    .field-error {
        --error-bg-red: #ffd3d3;
        --error-text: #d5150a;

        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        background-color: var(--error-bg-red);
        border: 1px solid var(--error-text);
        border-radius: 0.1rem;
        padding: 0 0.5rem;
        
    }

    .field-error p {
        font-size: var(--text-label);
        color: var(--error-text);
    }

    .icon {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 0.8rem;
        width: 0.8rem;
        color: var(--error-text);
        font-size: var(--text-section);
    }

    .icon:hover {
        color: #890000;
    }

    .btn.remove-error {
        height: 1.25rem;
        width: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 1rem;
        background-color: transparent;
        padding: 0;
        cursor: pointer;
    }

</style>