import type { RouteRecordRaw } from "vue-router";
import TicketShowPage from "./pages/TicketShowPage.vue";

export const ticketRoutes: RouteRecordRaw[] = [
    {
        path: "/tickets/:id",
        component: TicketShowPage,
        name: "ticket",
    },
];