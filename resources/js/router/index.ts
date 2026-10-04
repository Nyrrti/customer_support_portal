import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/LoginPage.vue';
import DashboardPage from '../pages/DashboardPage.vue';
import { ticketRoutes } from "../../domains/tickets/routes";
import { categoryRoutes } from "../../domains/categories/routes";
import { userRoutes } from "../../domains/users/routes";
import { authStore } from "../../domains/auth/store";

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

router.beforeEach(async (to) => {
    // Login page is public.
    if (to.name === "home") return true;

    // Check the current login session.
    await authStore.getUser();

    if (!authStore.user) {
        return { name: "home" };
    }

    // If no admin when required
    if (to.meta.requiresAdmin && !authStore.user.is_admin) {
        return { name: "tickets" };
    }

    return true;
});