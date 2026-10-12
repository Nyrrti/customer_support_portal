
import { ref } from "vue";

/**
 * Manages field errors for one form.
 *
 * Call this in the parent page and pass errors to the child form.
 * Each call creates its own independent error state.
 *
 * @returns The reactive errors and functions to manage them.
 */
export function useFieldError() {
    // Field names mapped to arrays of error messages.
    const errors = ref<Record<string, string[]>>({});


    /**
     * Sets one error message for a field, replacing its existing messages.
     *
     * @param field - The field name, such as "title".
     * @param message - The error message to display.
     */
    function setError(field: string, message: string) {
        errors.value[field] = [message];
    }
            
    /**
     * Replaces all field errors with a new set, such as Laravel's
     * validation errors from a 422 response.
     *
     * @param newErrors - Field names mapped to arrays of error messages.
     */
    function setErrors(newErrors: Record<string, string[]>) {
        errors.value = newErrors;
    }

    /**
     * Gets the error messages for one field.
     *
     * @param field - The field name, such as "title".
     * @returns The field's messages, or an empty array if none exist.
     */
    function getError(field: string): string[] {
        return errors.value[field] ?? [];
    }

    /**
     * Removes all error messages for one field.
     *
     * @param field - The field name to clear.
     */
    function clearError(field: string) {
        delete errors.value[field];
    }

    /**
     * Removes all field errors from the form.
     */
    function clearErrors() {
        errors.value = {};
    }

        return { 
            errors, 
            getError, 
            setError, 
            setErrors, 
            clearError, 
            clearErrors
        };
}

