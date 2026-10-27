import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/LoginPage.vue';
import DashboardPage from '../pages/DashboardPage.vue';
import { ticketRoutes } from "../../domains/tickets/routes";
import { categoryRoutes } from "../../domains/categories/routes";
import { userRoutes } from "../../domains/users/routes";
import { authStore } from "../../domains/auth/store";
import { destroyMessage } from "../services/error";
import { replyRoutes } from "../../domains/replies/routes";
import { noteRoutes } from "../../domains/notes/routes";

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
        ...ticketRoutes,
        ...categoryRoutes,
        ...userRoutes,
        ...replyRoutes,
        ...noteRoutes,
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
        return { name: "tickets-overview" };
    }

    return true;
});

/**
 * Clears the previous page's error message after navigation succeeds.
 */
router.afterEach((to, from, failure) => {
    if (!failure) {
        destroyMessage();
    }
});