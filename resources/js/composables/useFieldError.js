
    import { ref } from 'vue';

    export function useFieldError() {
        const errors = ref({});

        /**     
         * Sets an error message for one field.
         * 
         * @param {string} field - The field name, such as "email".
         * @param {string} message - The error message to display.
         */
        function setError(field, message) {
            errors.value[field] = message;
        }

        function setErrors(newErrors) {
            errors.value = newErrors;  
        }

        function getError(field) {
            return errors.value[field];
        }

        function clearError(field) {
            delete errors.value[field];
        }

        function clearErrors() {
            errors.value = {};
        }

        return { errors, getError, setError, setErrors, clearError, clearErrors}
    }

