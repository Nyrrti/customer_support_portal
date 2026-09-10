export interface User {
    id: number;
    name: string;
    email: string;
    is_admin: boolean;
};

export interface AuthStore {
    user: User | null;
    loading: boolean;
    login(email: string, password: string): Promise<boolean>;
    getUser(): Promise<void>;
    logout(): Promise<void>;
}