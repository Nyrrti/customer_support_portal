import type { User } from "../users/types";

export interface AuthStore {
    user: User | null;
    loading: boolean;
    login(email: string, password: string): Promise<boolean>;
    getUser(): Promise<void>;
    logout(): Promise<void>;
}