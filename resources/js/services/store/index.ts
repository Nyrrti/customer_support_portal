import { ref, computed } from 'vue';
import type { Ref } from "vue";
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
export const storeModuleFactory = <
        Item extends {id: number},
        CreateData,
        UpdateData
    >(moduleName: string) => {
    // Reactive storage for this module.
    // Example: the ticket store will keep its tickets here.
    const state: Ref<Record<number, Item>> = ref({});

    const getters = {
        // Read data from the store.
        // Example: ticketStore.getters.all.value returns all stored tickets.
        all: computed(() => state.value),
        // Give me a reactive getter for the item stored under this id.
        // Example: ticketStore.getters.getById(5).value
        getById: (id: number) => 
            computed<Item | undefined>(() => state.value[id])
    };

    const setters = {
        setAll: (items: Item[]) => {
            for (const item of items) {
                state.value[item.id] = Object.freeze(item);
            }
        },

        setOne: (item: Item) => {
            state.value[item.id] = Object.freeze(item);
        },

        deleteById: (id: number) => {
            delete state.value[id];
        }
    };

    const actions = {
        // Ask the backend for all items belonging to this module.
        // Example: moduleName "tickets" results in a GET request for "tickets".
        getAll: async () => {
            const { data } = await getRequest<Item[]>(moduleName);

            if (!data) return;
            setters.setAll(data);
        },
        create: async (item: CreateData) => {
            const { data } = await postRequest<Item>(moduleName, item);
            if (!data) return;
            setters.setOne(data);
        },
        update: async (id: number, item: UpdateData) => {
            const { data } = await putRequest<Item>(`${moduleName}/${id}`, item);
            if (!data) return;
            setters.setOne(data);
        },
        delete: async (id: number) => {
            await deleteRequest(`${moduleName}/${id}`);
            setters.deleteById(id);
        }
    };

    return { getters, setters, actions };
};