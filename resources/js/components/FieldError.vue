<script setup lang="ts">

    defineProps<{ errors?: string[] }>();

    const emit = defineEmits<{
        remove: [];
    }>();
</script>

<template>
    <div v-for="error in errors" :key="error" class="field-error">
        <p>
            {{ error }}
        </p>
        <button type="button" class="btn remove-error" @click="emit('remove')">
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
        color: #fff;
        font-size: var(--text-section);
    }

    .btn.remove-error {
        height: 1.25rem;
        width: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 1rem;
        background-color: var(--color-red);
        padding: 0;
    }

    .btn.remove-error:hover {
        background-color: var(--error-text);
    }

</style>