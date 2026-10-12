import { ref } from "vue";
import { isAxiosError } from "axios";
import { useFieldError } from "./useFieldError";
import { destroyMessage } from "../services/error";

/**
 * Manages submission, saving state, and field errors for one form.
 *
 * @returns The field errors, saving state, and submission function.
 */
export function useForm() {
    const { errors, setErrors, clearErrors, clearError } = useFieldError();
    const saving = ref(false);

    /**
     * Runs a store action and handles its validation errors.
     *
     * @param action - An asynchronous function that saves the form.
     * @returns Whether the action completed successfully.
     * @throws Unexpected errors that are not Axios errors.
     */
    async function submit(
        action: () => Promise<unknown>
    ): Promise<boolean> {
        // Prevent another submission while saving.
        if (saving.value) return false;

        clearErrors();
        destroyMessage();
        saving.value = true;

        try {
            await action();
            return true;
        } catch (error: unknown) {
            if (!isAxiosError<{
                errors?: Record<string, string[]>;
            }>(error)) {
                throw error;
            }

            if (error.response?.status === 422) {
                setErrors(error.response.data.errors ?? {});
            }

            // The Axios interceptor handles general request messages.
            return false;
        } finally {
            saving.value = false;
        }
    }

    return { errors, saving, submit, clearError };
}