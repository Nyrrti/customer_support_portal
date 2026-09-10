import { reactive } from "vue";
import axios from "axios";
import type { AuthStore } from "./types";

export const authStore = reactive<AuthStore>({
    user: null,
    loading: false,

    async getUser() {
        this.loading = true;

        try {
            const response = await axios.get("/api/user");

            this.user = response.data.user;
        } catch (error) {
            this.user = null;
        } finally {
            this.loading = false;
        }
    },

    /**
     * Login
     * 
     * @param email 
     * @param password 
     */
    async login(email: string, password: string) {
        await axios.get("/sanctum/csrf-cookie");

        await axios.post("/api/login", {
            email,
            password,
        });

        await this.getUser();
        return true;
    },

    async logout() {
        await axios.post("/api/logout");

        this.user = null;
    },
});