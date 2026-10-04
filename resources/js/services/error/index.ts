import { computed, ref } from "vue";

export interface ErrorBag {
    [property: string]: string[];
}

const errorBag = ref<ErrorBag>({});
const message = ref("");

export const getErrorBag = computed(() => errorBag.value);
export const getMessage = computed(() => message.value);

export const getErrorByProperty = (property: string) =>
    computed(() => errorBag.value[property] ?? []);

export function setErrorBag(bag: ErrorBag) {
    errorBag.value = bag;
}

export function setMessage(newMessage: string) {
    message.value = newMessage || "Something went wrong. Please try again.";
}

export function destroyErrors() {
    errorBag.value = {};
}

export function destroyMessage() {
    message.value = "";
}