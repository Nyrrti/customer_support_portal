
import { storeModuleFactory } from '../../js/services/store';
import { patchRequest } from "../../js/services/http";
import type { Ticket, CreateTicket, UpdateTicket, TicketStatus } from './types';


const baseStore = storeModuleFactory<
    Ticket,
    CreateTicket,
    UpdateTicket
>("tickets");

export const ticketStore = {
    ...baseStore,

    actions: {
        ...baseStore.actions,

        /**
         * Saves a new status and updates the ticket in the store.
         *
         * @param id - The ticket ID.
         * @param status - The new ticket status.
         * @returns A promise that resolves after updating the store.
         */
        updateStatus: async (
            id: number,
            status: TicketStatus
        ): Promise<void> => {
            const { data } = await patchRequest<Ticket>(
                `tickets/${id}/status`,
                { status }
            );

            baseStore.setters.setOne(data);
        }
    }
};