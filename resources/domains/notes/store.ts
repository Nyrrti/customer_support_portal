import { storeModuleFactory } from "../../js/services/store/index";
import type { Note, CreateNote, UpdateNote } from './types';
import { getRequest } from "../../js/services/http";


const baseStore = storeModuleFactory<
    Note,
    CreateNote,
    UpdateNote
>("notes");

export const noteStore = {
    getters: baseStore.getters,
    setters: baseStore.setters,
    actions: { 
        ...baseStore.actions,
        getByTicket 
    }
};

/**
 * Refreshes the notes for one ticket.
 * @param ticketId - The ticket to load notes for.
 * 
 */
async function getByTicket(ticketId: number): Promise<void> {
    const { data } = await getRequest<Note[]>(
    // Get the notes related to this ticketId
        `tickets/${ticketId}/notes`
    );
    // Clear old notes for this ticket.
    for (const note of Object.values(baseStore.getters.all.value)) {
        if (note.ticket_id === ticketId) {
            baseStore.setters.deleteById(note.id);
        }
    }
    // Insert the latest notes.
    for (const note of data) {
        baseStore.setters.setOne(note);
    }
}