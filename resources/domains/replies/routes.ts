import type { RouteRecordRaw } from "vue-router";
import Create from "./pages/Create.vue"
import Edit from "./pages/Edit.vue"


export const replyRoutes: RouteRecordRaw[] = [
  
    {
        path: "/replies/create",
        component: Create,
        name: "create-reply",
    },
    {
        path: "/replies/:id/edit",
        component: Edit,
        name: "edit-reply",
    },
]
