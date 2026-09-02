import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/LoginPage.vue';
import DashboardPage from '../pages/DashboardPage.vue';
import { ticketRoutes } from "../../domains/tickets/routes";

export const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/',
            component: LoginPage,
            name: 'home',
        },
        {
            path: '/tickets',
            component: DashboardPage,
            name: 'dashboard',
        },
        ...ticketRoutes,
    ],
});