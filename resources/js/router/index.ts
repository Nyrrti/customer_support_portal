import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/LoginPage.vue';
import DashboardPage from '../pages/DashboardPage.vue';
import { ticketRoutes } from "../../domains/tickets/routes";
import { categoryRoutes } from "../../domains/categories/routes";
import { userRoutes } from "../../domains/users/routes";

export const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/',
            component: LoginPage,
            name: 'home',
        },
        {
            path: '/dashboard',
            component: DashboardPage,
            name: 'dashboard',
        },
        {
            path: '/tickets',
            component: DashboardPage,
            name: 'tickets',
        },
        ...ticketRoutes,
        ...categoryRoutes,
        ...userRoutes,
    ],
});