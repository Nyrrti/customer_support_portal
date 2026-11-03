import type { RouteRecordRaw } from "vue-router";
import UserPage from "./pages/UserPage.vue"
import Edit from "./pages/Edit.vue"


export const userRoutes: RouteRecordRaw[] = [
    
    {
        path: "/users",
        component: UserPage,
        name: "users-overview",
        meta: { requiresAdmin: true },
    },
    {
        path: "/users/:id/edit",
        component: Edit,
        name: "edit-user",
        meta: { requiresAdmin: true },
    },
]