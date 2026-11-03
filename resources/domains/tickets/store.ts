
import { storeModuleFactory } from '../../js/services/store';
import { patchRequest } from "../../js/services/http";
import type { Ticket, CreateTicket, UpdateTicket, TicketStatus } from './types';


const baseStore = storeModuleFactory<
    Ticket,
    CreateTicket,
    UpdateTicket
>("tickets");

export const ticketStore = {
    getters: baseStore.getters,
    setters: baseStore.setters,
    actions: {
        ...baseStore.actions,
        updateStatus,
        updateAssigned
    }
};
    

/**
 * Saves a new status and updates the ticket in the store.
 *
 * @param id - The ticket ID.
 * @param status - The new ticket status.
 */
async function updateStatus(id: number, status: TicketStatus): Promise<void> 
{
    const { data } = await patchRequest<Ticket>(
        `tickets/${id}/status`,
        { status }
    );

    baseStore.setters.setOne(data);
}

/**
 * Assigns a ticket to a user.
 */
async function updateAssigned(id: number, assignedToId: number | null): Promise<void> 
{
    const { data } = await patchRequest<Ticket>(
        `tickets/${id}/assigned`,
        { assigned_to_id: assignedToId }
    );

    baseStore.setters.setOne(data);
}
