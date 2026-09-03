
import axios from 'axios';
import { ref, computed } from 'vue';
import type { Ticket } from './types';

// state
const tickets = ref<Ticket[]>([])

// getters
export const getAllTickets = computed(() => tickets.value);

// actions
export const fetchTickets = async () => {
    const {data} = await axios.get('/api/tickets');
    if(!data) return
    tickets.value = data;
};

export const createTicket = async (newTicket) => {
    const {data} = await axios.post('/api/books', newTicket);
    if(!data) return
    tickets.value = data;
};