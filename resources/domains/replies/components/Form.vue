<script setup lang="ts">
    import { ref, computed } from "vue";
    import { useRoute, useRouter } from "vue-router"
    import type { CreateReply, Reply } from "../types";
    import FieldError from "../../../js/components/FieldError.vue";

    const route = useRoute()
    const router = useRouter()

    const returnTo = computed(() => {
        const value = route.query.returnTo

        return typeof value === 'string' && value.startsWith('/tickets/')
            ? value
            : { name: 'tickets-overview' }
    });

    const props = defineProps<{
        mode: "create" | "edit"
        reply?: Reply;
        errors: Record<string, string[]>;
        saving: boolean;
    }>();
    
    const reply = ref<CreateReply>({
        title: props.reply?.title ?? "",
        content: props.reply?.content ?? "",
    });

    const emit = defineEmits<{
        submit: [reply: CreateReply];
        "dismiss-error": [field: string];
    }>();

    const submitForm = () => {
        emit("submit", reply.value);
    };
</script>

<template>
    <div class="nav-link my-2 p-2">
        <RouterLink :to="returnTo">
            Ticket
        </RouterLink>
        <span>
            > {{ mode === "create" ? "Create new reply" : "Edit reply" }}
        </span>
    </div>
    <form class="reply-form-bg"  @submit.prevent="submitForm">
        <div class="reply-form-heading p-4">
            <div class="d-flex items-center">
                <div class="reply-form-icon me-1" aria-hidden="true">
                    <svg
                        viewBox="0 0 24 24"
                        width="40"
                        height="40"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1"
                    >
                        <path d="M4 7a2 2 0 0 1 2-2h12v4a2 2 0 0 0 0 4v4H6a2 2 0 0 1-2-2v-2a2 2 0 0 0 0-4V7Z" />
                        <path d="M9 8v8" stroke-dasharray="2 2" />
                    </svg>
                </div>
                <h5>
                    {{ mode === "create" ? "Create new reply" : "Edit reply" }}
                </h5>
            </div>
            <RouterLink
                :to="{ name: 'tickets-overview' }"
                class="reply-form-icon form-close"
                aria-label="Back to ticket"
            >
                
            </RouterLink>
            <RouterLink 
                :to="returnTo"
                class="reply-form-icon form-close"
                aria-label="Back to ticket"
            >
                ↩
            </RouterLink>
        </div>
        <div class="reply-form-input-field">
            <div class="field">
                <label for="title">
                    Title
                </label>
                <input 
                    id="title"
                    v-model="reply.title"
                    type="text"
                >
                <FieldError 
                    :errors="errors.title"
                    @dismiss="emit('dismiss-error', 'title')" 
                />
            </div>
            <div class="field">
                <label for="content">
                    Description
                </label>
                <textarea
                    id="content"
                    v-model="reply.content"
                >
                </textarea>
                <FieldError 
                    :errors="errors.content"
                    @dismiss="emit('dismiss-error', 'content')" 
                />
            </div>
        </div>
        <div class="reply-form-footer p-4">
            <button 
                class="btn create" 
                type="submit"
                :disabled="saving"
            >
                {{
                    saving
                        ? "Saving..."
                        : mode === "create"
                            ? "Create reply"
                            : "Edit reply"
                }}
            </button>
        </div>
    </form>
</template>

<style scoped>

    .nav-link span {
        color: var(--font-color-medium-light);
    }

    .reply-form-bg {
        background-color: var(--bg-color-card);    
        border-radius: 0.6rem;
        border: 1px solid var(--bg-color-card-dark);
        box-shadow: 0 0.45rem 1.25rem rgba(15, 29, 51, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .reply-form-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 0.6rem 0.6rem 0 0;
        background: var(--bg-color-card-dark);
        background: linear-gradient(150deg, 
            rgb(136, 82, 206) 0%, 
            rgb(85, 122, 192) 40%, 
            rgb(85, 122, 192) 60%, 
            rgb(44, 136, 182) 100%
        );   
        position: relative;
    }

    .reply-form-heading h5 {
        color: var(--font-color-light);
    }

    .reply-form-icon {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        color: var(--font-color-light);
    }

    .form-close {
        width: 2.25rem;
        height: 2.25rem;
        border: 3px dashed var(--font-color-light);
        border-radius: 1.5rem;
        font-size: var(--font-size-md); 
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    .form-close:hover {
        border: 3px dashed var(--color-yellow);
        color: var(--color-yellow);
    }

    .reply-form-input-field {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem 1.5rem 0rem 1.5rem;
    }

    .reply-form-input-field input {
        width: 100%;
        padding: 0.7rem;
        background-color: var(--bg-color-card);
        border: 1px solid var(--border-input-light);
        border-radius: 0.4rem;
    }

    .reply-form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn.create {
        width: 100%;
    }
</style>