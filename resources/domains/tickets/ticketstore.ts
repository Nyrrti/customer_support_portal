import axios from 'axios';
import { ref, computed } from 'vue';

// state
const tickets = ref([]);

// getters
export const getAllTickets = computed(() => tickets.value);

// actions
export const fetchTickets = async () => {
    const {data} = await axios.get('/api/tickets');
    if(!data) return
    tickets.value = data;
};