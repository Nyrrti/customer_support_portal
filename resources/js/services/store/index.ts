import { ref, computed } from 'vue';
import {    
    getRequest,
    postRequest,
    putRequest,
    deleteRequest 
} from '../http';

/**
 * Creates a reusable store module.
 *
 * @param moduleName - Name of the module, for example "tickets" or "categories".
 * @returns An object containing getters, setters, and actions for the store.
 */
export const storeModuleFactory = (moduleName: string) => {
    // Reactive storage for this module.
    // Example: the ticket store will keep its tickets here.
    const state = ref({});

    const getters = {
        // Read data from the store.
        // Example: ticketStore.getters.all.value returns all stored tickets.
        all: computed(() => state.value),
        // Give me a reactive getter for the item stored under this id.
        // Example: ticketStore.getters.getById(5).value
        getById: (id) => computed(() => state.value[id])
    };

    const setters = {
        setAll: (items) => {
            for (const item of items) {
                state.value[item.id] = Object.freeze(item);
            }
        },

        setOne: (item) => {
            state.value[item.id] = Object.freeze(item);
        },

        deleteById: (id) => {
            delete state.value[id];
        }
    };

    const actions = {
        // Ask the backend for all items belonging to this module.
        // Example: moduleName "tickets" results in a GET request for "tickets".
        getAll: async () => {
            const { data } = await getRequest(moduleName);

            if (!data) return;
            setters.setAll(data);
        },
        create: async (item) => {
            const { data } = await postRequest(moduleName, item);
            if (!data) return;
            setters.setOne(data);
        },
        update: async (id, item) => {
            const { data } = await putRequest(`${moduleName}/${id}`, item);
            if (!data) return;
            setters.setOne(data);
        },
        delete: async (id) => {
            await deleteRequest(`${moduleName}/${id}`);
            setters.deleteById(id);
        }
    };

    return { getters, setters, actions };
};