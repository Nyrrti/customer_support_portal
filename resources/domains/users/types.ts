export interface User {
        id: number;
        first_name: string;
        last_name: string;
        name: string;
        email: string;
        phone_number: number;
    }

    export interface CreateUser {
        first_name: string;
        last_name: string;
        email: string;
        phone_number: number | null;
    }

    export interface UpdateUser {
        user_id: number;
        first_name?: string;
        last_name?: string;
        email?: string;
        phone_number?: number;
    }