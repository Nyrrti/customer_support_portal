import { computed, ref } from "vue";

const message = ref("");

export const getMessage = computed(() => message.value);

/**
 * Sets the general error message.
 *
 * @param newMessage - The message to display.
 */
export function setMessage(newMessage: string): void {
    message.value =
        newMessage || "Something went wrong. Please try again.";
}

/** Clears the general error message. */
export function destroyMessage(): void {
    message.value = "";
}

