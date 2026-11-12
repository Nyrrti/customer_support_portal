import { reactive } from "vue";
import axios from "axios";
import type { AuthStore, ResetPasswordData } from "./types";
import { ticketStore } from "../tickets/store";
import { categoryStore } from "../categories/store";
import { userStore } from "../users/store";
import { replyStore } from "../replies/store";
import { noteStore } from "../notes/store";
import type { RegisterUser } from "./types";
import { postRequest } from "../../js/services/http";


/**
 * Removes cached data belonging to the current session.
 */
function clearStores(): void {
    ticketStore.setters.clearAll();
    categoryStore.setters.clearAll();
    userStore.setters.clearAll();
    replyStore.setters.clearAll();
    noteStore.setters.clearAll();
}

// Application session state
export const authStore = reactive<AuthStore>({
    user: null,
    loading: false,


    async getUser() 
    {
        this.loading = true;

        try {
            const response = await axios.get("/api/user");
            const nextUser = response.data.user;

            // Clear the previous account data before switching
            if (this.user?.id !== nextUser?.id) {
                clearStores();
            }

            this.user = nextUser;
        } catch (error: unknown) {
            if (
                axios.isAxiosError(error) &&
                error.response?.status === 401
            ) {
                clearStores();
                this.user = null;
            } else {
                throw error;
            }
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
    async login(email: string, password: string) 
    {
        await axios.get("/sanctum/csrf-cookie");

        await axios.post("/api/login", {
            email,
            password,
        });

        await this.getUser();
        return true;
    },

    /**
     * Ends the session and clears cached account data.
     */
    async logout() 
    {
        await axios.post("/api/logout");

        clearStores();
        this.user = null;
    },

    async register(data: RegisterUser) 
    {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/api/register", data);
        await this.getUser();
    },

    async forgotPassword(email: string)
    {
        const { data } = await postRequest<{ message: string}>(
            "forgot-password",
            { email }
        );
        return data;
    },

    async resetPassword(payload: ResetPasswordData)
    {
        const { data } = await postRequest<{message: string}>(
            "reset-password",
            payload
        );
        return data;
    },

});