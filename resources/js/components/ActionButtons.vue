<script setup>
    import { RouterLink } from 'vue-router'

    defineProps({
        editTo: { type: [Object, String], required: true }, // Route location for the edit button, example: { name: "edit-category", params: { id: 1 } }
        label: { type: String, default: "item" }, // Used in aria-labels, example "category" -> "Edit category"
        deleting: { type: Boolean, default: false },
        align: { type: String, default: "end" }, 
    })

    const emit = defineEmits(['delete'])
</script>

<template>
    <div class="actions" :class="{ 'is-end': align === 'end' }">
    <RouterLink
      :to="editTo"
      class="icon-btn edit"
      :aria-label="`Edit ${label}`"
      :title="`Edit ${label}`"
    >
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M12 20h9" />
        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
      </svg>
    </RouterLink>

    <button
        type="button"
        class="icon-btn delete"
        :aria-label="`Delete ${label}`"
        :title="`Delete ${label}`"
        :disabled="deleting"
        @click="emit('delete')"
    >
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
           stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 6h18" />
        <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2" />
        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
        <path d="M10 11v6M14 11v6" />
      </svg>
    </button>
  </div>
</template>

<style scoped>
    .actions {
        display: flex;
        gap: 0.8rem;
    }

    .actions.is-end {
        justify-content: flex-end;
    }

    .icon-btn {
        --btn-size: 44px;
        --icon-size: 22px;

        width: var(--btn-size);
        height: var(--btn-size);
        display: inline-grid;
        place-items: center;
        padding: 0;
        border: 1px solid transparent;
        border-radius: 0.6rem;
        background: transparent;
        color: var(--color-grey);
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s, color 0.15s, transform 0.1s;
    }

   .icon-btn svg {
        width: var(--icon-size);
        height: var(--icon-size);
    }

    .icon-btn:hover {
        background: var(--bg-color-card);
    }

    .icon-btn:active {
        transform: scale(0.92);
    }

    .icon-btn:focus-visible {
        outline: 2px solid var(--color-blue);
        outline-offset: 2px;
    }

    .icon-btn.edit:hover {
        background: #e0edff;
        color: var(--color-blue);
    }

    .icon-btn.delete:hover {
        background: #fef2f2;
        color: var(--color-red);
    }

</style>