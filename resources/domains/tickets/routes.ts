import type { RouteRecordRaw } from "vue-router";
import TicketDetailPage from "./pages/TicketDetailPage.vue";
import Create from "./pages/Create.vue"
import TicketsOverview from "./components/TicketsOverview.vue";

export const ticketRoutes: RouteRecordRaw[] = [
    
    {
        path: "/tickets/:id",
        component: TicketDetailPage,
        name: "ticket",
    },
    {
        path: "/tickets/create",
        component: Create,
        name: "create",
    },
]
