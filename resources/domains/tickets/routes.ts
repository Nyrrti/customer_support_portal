import type { RouteRecordRaw } from "vue-router";
import TicketDetailPage from "./pages/TicketDetailPage.vue";
import Create from "./pages/Create.vue"
import Edit from "./pages/Edit.vue"


export const ticketRoutes: RouteRecordRaw[] = [
    
    {
        path: "/tickets/:id",
        component: TicketDetailPage,
        name: "ticket-detail",
    },
    {
        path: "/tickets/create",
        component: Create,
        name: "create-ticket",
    },
    {
        path: "/tickets/:id/edit",
        component: Edit,
        name: "edit-ticket",
    },
]
