import type { RouteRecordRaw } from "vue-router";
import CategoryPage from "./pages/CategoryPage.vue"
import Create from "./pages/Create.vue"
import Edit from "./pages/Edit.vue"


export const categoryRoutes: RouteRecordRaw[] = [
    
    {
        path: "/categories",
        component: CategoryPage,
        name: "category-overview",
    },
    {
        path: "/categories/create",
        component: Create,
        name: "create-category",
    },
    {
        path: "/categories/:id/edit",
        component: Edit,
        name: "edit-category",
    },
]