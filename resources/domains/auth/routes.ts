import type { RouteRecordRaw } from "vue-router";
import RegisterPage from "./pages/RegisterPage.vue";
import ForgotPasswordPage from "./pages/ForgotPasswordPage.vue";


export const authRoutes: RouteRecordRaw[] = [
    
    {
        path: "/register",
        component: RegisterPage,
        name: "register",
        meta: { public: true },
    },
    {
        path: "/forgot-password",
        component: ForgotPasswordPage,
        name: "forgot-password",
        meta: { public: true },
    },

]