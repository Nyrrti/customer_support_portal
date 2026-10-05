
import { storeModuleFactory } from '../../js/services/store';
import type { Ticket, CreateTicket, UpdateTicket } from './types';


export const ticketStore = storeModuleFactory<
    Ticket,
    CreateTicket,
    UpdateTicket
>("tickets");
