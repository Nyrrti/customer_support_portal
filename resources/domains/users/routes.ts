import type { RouteRecordRaw } from "vue-router";
import UserPage from "./pages/UserPage.vue"
import Create from "./pages/Create.vue"
import Edit from "./pages/Edit.vue"


export const userRoutes: RouteRecordRaw[] = [
    
    {
        path: "/users",
        component: UserPage,
        name: "user-overview",
    },
    {
        path: "/users/create",
        component: Create,
        name: "create-user",
    },
    {
        path: "/users/:id/edit",
        component: Edit,
        name: "edit-user",
    },
]