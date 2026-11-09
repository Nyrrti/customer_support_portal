import type { RouteRecordRaw } from "vue-router";
import RegisterPage from "./pages/RegisterPage.vue";


export const authRoutes: RouteRecordRaw[] = [
    
    {
        path: "/register",
        component: RegisterPage,
        name: "register",
        meta: { public: true },
    },

]