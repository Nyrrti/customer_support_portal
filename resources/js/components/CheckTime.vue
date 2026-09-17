<script setup lang="ts">
    import { computed } from "vue";

    const props = defineProps({
        date: {
            type: String,
            required: true
        }
    })

    /**
     * Format how long ago since the database timestamp has been updated
     * 
     * @param data Get the timestamp of database table updated_at
     */
    function formattedUpdateTime(data: string) {
        const startDate = new Date(data);
        const now = new Date();
        const elapsedSeconds = Math.floor(
            (now.getTime() - startDate.getTime()) / 1000
        );

        const minutes = Math.floor(elapsedSeconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (elapsedSeconds < 60) {
            return "Just now";
        }
        if (minutes < 60) {
            return `${minutes}m ago`;
        }
        if (hours < 24) {
           return `${hours}h ago`;
        }
        
        return `${days}d ago`;
    
    }



</script>

<template>
    <span>
        {{ formattedUpdateTime(props.date) }}
    </span>
</template>

