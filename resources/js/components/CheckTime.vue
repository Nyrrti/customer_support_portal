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
    function formattedUpdate(data: string) {
        const startDate = new Date(data);
        const now = new Date();
        const elapsedSeconds = Math.floor((now.getTime() - startDate.getTime()) / 1000);

        const days = Math.floor(elapsedSeconds / 86400);
        const hours = Math.floor((elapsedSeconds % 86400) / 3600);
        const minutes = Math.floor((elapsedSeconds % 3600) / 60);
        const seconds = elapsedSeconds % 60;

        let result;
        
        if (elapsedSeconds > 60) {
            result = `${minutes} minute(s) ago`;
        }
        if (elapsedSeconds > 3600) {
            result = `${hours} hour(s) ago`;
        }
        if (elapsedSeconds > 86400) {
            result = `${days} day(s) ago`;
        }
        else {
            result = "Just now";
        }
        return result;
    }



</script>

<template>
    <span>
        Updated: {{ formattedUpdate(props.date) }}
    </span>
</template>

