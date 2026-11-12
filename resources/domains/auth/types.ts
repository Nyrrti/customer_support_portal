import type { User, CreateUser } from "../users/types";

export interface AuthStore {
    user: User | null;
    loading: boolean;
    login(email: string, password: string): Promise<boolean>;
    getUser(): Promise<void>;
    logout(): Promise<void>;
    register(data: RegisterUser): Promise<void>;
    
    forgotPassword(email: string): Promise<{ message: string }>;
    resetPassword(payload: ResetPasswordData): Promise<{ message: string }>;
}
export interface RegisterUser extends CreateUser 
{
    password: string;
    password_confirmation: string;
}

export interface ResetPasswordData 
{
    email: string;
    token: string;
    password: string;
    password_confirmation: string;
}



