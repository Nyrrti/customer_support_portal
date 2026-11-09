import type { User, CreateUser } from "../users/types";

export interface AuthStore {
    user: User | null;
    loading: boolean;
    login(email: string, password: string): Promise<boolean>;
    getUser(): Promise<void>;
    logout(): Promise<void>;
    register(data: RegisterUser): Promise<void>;
}
export interface RegisterUser extends CreateUser {
    password: string;
    password_confirmation: string;
}

