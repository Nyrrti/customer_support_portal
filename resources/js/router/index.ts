import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/LoginPage.vue';
import DashboardPage from '../pages/DashboardPage.vue';
import TicketShowPage from '../pages/TicketShowPage.vue';

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: LoginPage,
            name: 'home',
        },
        {
            path: '/logged',
            component: DashboardPage,
            name: 'dashboard',
        },
        {
            path: '/ticket',
            component: TicketShowPage,
            name: 'ticket',
        },

    ],
});