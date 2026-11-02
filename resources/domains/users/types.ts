export interface User {
        id: number;
        first_name: string;
        last_name: string;
        name: string;
        email: string;
        phone_number: string | null;
        is_admin: boolean;
    }

    export interface CreateUser {
        first_name: string;
        last_name: string;
        email: string;
        phone_number: string | null;
    }

    export type UpdateUser = CreateUser;