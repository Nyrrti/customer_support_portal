import type { RouteRecordRaw } from "vue-router";
import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";


export const noteRoutes: RouteRecordRaw[] = [
  
    {
        path: "/tickets/:id/notes/create",
        component: Create,
        name: "create-note",
    },
    {
        path: "/notes/:id/edit",
        component: Edit,
        name: "edit-note",
    },
]
