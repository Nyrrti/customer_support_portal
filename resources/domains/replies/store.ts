import { storeModuleFactory } from "../../js/services/store/index";
import type { Reply, CreateReply, UpdateReply } from './types';
import { getRequest } from "../../js/services/http";


const baseStore = storeModuleFactory<
    Reply,
    CreateReply,
    UpdateReply
>("replies");

export const replyStore = {
    getters: baseStore.getters,
    setters: baseStore.setters,
    actions: { getByTicket }
};

/**
 * Refreshes the replies for one ticket.
 * @param ticketId - The ticket to load replies for.
 * 
 */
async function getByTicket(ticketId: number): Promise<void> {
    const { data } = await getRequest<Reply[]>(
        `tickets/${ticketId}/replies`
    );

    for (const reply of Object.values(baseStore.getters.all.value)) {
        if (reply.ticket_id === ticketId) {
            baseStore.setters.deleteById(reply.id);
        }
    }

    for (const note of data) {
        baseStore.setters.setOne(note);
    }
}